<?php

namespace App\Http\Controllers\Member;

use App\Models\Member;
use App\Models\ClassModel;
use App\Jobs\ProcessBooking;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\GymClass;
use App\Models\Booking;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::paginate(6);

        // Load booking count
        $classes = \App\Models\GymClass::withCount('bookings')->paginate(6); 
        $userClasses = collect();
        
        // check apkaah user jadi member di suatu class atau tidack
        if (Auth::check() && Auth::user()->role->name === 'member') {
            $member = Auth::user()->member;
            if ($member) {
                    $userClasses = $member->bookings()
                        ->select('class_id', 'tanggal_booking')
                        ->get()
                        ->map(function ($b) {
                            $b->expired_at = null;
                            return $b;
                        });
            }
        }

        $pending = session('pending_bookings', []);
        if (!empty($pending)) {
            // Ambil semua class_id yang user sudah booking
            $joinedIds = $userClasses->pluck('class_id')->map(fn($v) => (int) $v)->toArray();
            
            // Hapus dari pending jika sudah ada di bookings
            $stillPending = array_filter($pending, function ($classId) use ($joinedIds) {
                return !in_array((int) $classId, $joinedIds);
            });
            
            // Update session dengan pending yang masih valid
            session(['pending_bookings' => array_values($stillPending)]);
        }

        return view('landing_page.pages.classes', compact('classes', 'userClasses'));
    }

    public function join($classId)
    {
        $user = Auth::user();

        // Affakah member
        $member = Member::where('user_id', $user->user_id)->first();
        if (!$member) {
            return back()->with('error', 'Anda belum menjadi member.');
        }

        // Membership masih aktif gak
        if ($member->expired_at && $member->expired_at < Carbon::now()) {
            return back()->with('error', 'Membership Anda sudah expired!');
        }

        $class = GymClass::findOrFail($classId);

        // Cek apakah sudah pernah join sebelumnya
        $already = Booking::where('member_id', $member->member_id)
            ->where('class_id', $class->class_id)
            ->exists();

        if ($already) {
            return back()->with('error', 'Anda sudah terdaftar di kelas ini.');
        }
        
        // precheck
        $joinedCount = $class->bookings()->count();
        if ($joinedCount >= (int)$class->kapasitas) {
            return back()->with('error', 'Kelas sudah penuh!');
        }

        Booking::create([
            'member_id' => $member->member_id,
            'class_id' => $class->class_id,
            'tanggal_booking' => now(),
        ]);

        $pending = session('pending_bookings', []);
        $pending = array_filter($pending, fn($id) => $id != $class->class_id);
        session(['pending_bookings' => array_values($pending)]);

        return back()->with('success', 'Berhasil bergabung dengan kelas!');
    }

    public function memberClasses()
    {
        $user = Auth::user();
        $member = Member::where('user_id', $user->user_id)->first();
        $classes = $member->bookings()->select('class_id', 'tanggal_booking')->get();
        return view('member.classes.index', compact('classes'));
    }

    public function jadwalku()
{
    $user = Auth::user();
    $member = Member::where('user_id', $user->user_id)->first();

    // Ambil kelas yang sudah diikuti
    $classes = Booking::with('class')
        ->where('member_id', $member->member_id)
        ->get()
        ->pluck('class');

    // Generate jadwal bulan ini
    $now = now();
    $startMonth = $now->copy()->startOfMonth();
    $endMonth   = $now->copy()->endOfMonth();

    $events = [];

    foreach ($classes as $class) {
        $dayIndex = [
            'senin' => 2,
            'selasa' => 3,
            'rabu' => 4,
            'kamis' => 5,
            'jumat' => 6,
            'sabtu' => 7,
            'minggu' => 1,
        ][strtolower($class->hari)] ?? null;

        if ($dayIndex === null) continue;

        $current = $startMonth->copy()->next($dayIndex);
        if ($current->month !== $startMonth->month) {
            $current->subWeek();
        }

        while ($current->lte($endMonth)) {
            $events[] = [
                'date' => $current->format('Y-m-d'),
                'class' => $class
            ];
            $current->addWeek();
        }
    }

    return view('member.jadwal.index', [
        'events' => $events,
        'month' => $now,
    ]);
}

}
