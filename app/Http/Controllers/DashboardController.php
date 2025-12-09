<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Redirect ke dashboard sesuai role.
     */
    public function index(): RedirectResponse
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->isAdmin())   return redirect()->route('admin.dashboard');
        if ($user->isTrainer()) return redirect()->route('trainer.dashboard');
        if ($user->isMember())  return redirect('/');

        
        // Fallback jika role tidak dikenali
        return redirect('/');
    }

    /**
     * Admin Dashboard → resources/views/admin/dashboard.blade.php
     */
    public function admin(): View
    {
        /** @var User|null $user */
        $user = Auth::user();
        abort_unless($user && $user->isAdmin(), 403, 'You do not have permission to access admin dashboard.');

        if (!$user->isAdmin()) {
            abort(403, 'You do not have permission to access admin dashboard.');
        }

    return view('admin.dashboard');
    }

    /**
     * Trainer Dashboard
     */
    public function trainer(): View
    {
        /** @var User|null $user */
        $user = Auth::user();
        $hasTrainerRecord = method_exists($user, 'trainer') ? (bool) $user->trainer : false;
        abort_unless($user && ($user->isTrainer() || $hasTrainerRecord), 403, 'You do not have permission to access trainer dashboard.');

        $trainer = $user->trainer;
        $stats = [
            'total_members' => 0,
            'next_schedule' => null,
            'top_class' => null,
            'top_class_count' => 0,
        ];

        if ($trainer) {
            // 1. Total unique members across all trainer's classes
            $stats['total_members'] = \App\Models\Booking::whereHas('class', function($q) use ($trainer) {
                $q->where('trainer_id', $trainer->trainer_id);
            })->distinct('member_id')->count('member_id');

            // 2. Nearest upcoming schedule (today or future, sorted by day of week + time)
            $today = now();
            $currentDayName = strtolower($today->locale('id')->dayName);
            $currentTime = $today->format('H:i:s');
            
            $upcomingClass = \App\Models\GymClass::where('trainer_id', $trainer->trainer_id)
                ->where(function($q) use ($currentDayName, $currentTime) {
                    // Same day but later time, or future days
                    $q->where('hari', $currentDayName)
                      ->where('waktu_mulai', '>', $currentTime)
                      ->orWhere(function($qq) use ($currentDayName) {
                          $dayOrder = ['senin'=>1,'selasa'=>2,'rabu'=>3,'kamis'=>4,'jumat'=>5,'sabtu'=>6,'minggu'=>7];
                          $currentOrder = $dayOrder[$currentDayName] ?? 0;
                          // Get classes on future days of the week
                          $qq->whereIn('hari', array_keys(array_filter($dayOrder, fn($v) => $v > $currentOrder)));
                      });
                })
                ->orderByRaw("FIELD(hari, 'senin','selasa','rabu','kamis','jumat','sabtu','minggu')")
                ->orderBy('waktu_mulai')
                ->first();
            
            $stats['next_schedule'] = $upcomingClass;

            // 3. Most popular class (highest booking count)
            $topClass = \App\Models\GymClass::where('trainer_id', $trainer->trainer_id)
                ->withCount('bookings')
                ->orderByDesc('bookings_count')
                ->first();
            
            if ($topClass) {
                $stats['top_class'] = $topClass;
                $stats['top_class_count'] = $topClass->bookings_count;
            }
        }

        return view('trainer.trainerDashboard', compact('stats'));
    }

    /**
     * Member Dashboard → resources/views/member/dashboard.blade.php
     */
    public function member(): View
    {
        /** @var User|null $user */
        $user = Auth::user();
        abort_unless($user && $user->isMember(), 403, 'You do not have permission to access member dashboard.');

        return view('member.dashboard');
    }
}
