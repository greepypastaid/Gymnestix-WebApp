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
        if ($user->isMember())  return redirect()->route('member.dashboard');

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
        // Allow access if the user has the trainer role OR has a linked trainer record
        $hasTrainerRecord = method_exists($user, 'trainer') ? (bool) $user->trainer : false;
        abort_unless($user && ($user->isTrainer() || $hasTrainerRecord), 403, 'You do not have permission to access trainer dashboard.');

        return view('pages.dashboard.trainer.trainerDashboard');
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
