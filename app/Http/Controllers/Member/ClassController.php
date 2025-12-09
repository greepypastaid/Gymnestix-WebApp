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

    public function join(GymClass $class)
    {
        $user = Auth::user();

        // Log untuk debugging
        \Log::info('Join class attempt', [
            'user_id' => $user->user_id,
            'class_id' => $class->class_id,
        ]);

        // Apakah member
        $member = Member::where('user_id', $user->user_id)->first();
        if (!$member) {
            \Log::warning('User is not a member', ['user_id' => $user->user_id]);
            return back()->with('error', 'Anda belum menjadi member.');
        }

        // Membership masih aktif gak
        if ($member->expired_at && $member->expired_at < Carbon::now()) {
            \Log::warning('Member membership expired', ['member_id' => $member->member_id]);
            return back()->with('error', 'Membership Anda sudah expired!');
        }

        // Cek apakah sudah pernah join sebelumnya
        $already = Booking::where('member_id', $member->member_id)
            ->where('class_id', $class->class_id)
            ->exists();

        if ($already) {
            return back()->with('error', 'Anda sudah terdaftar di kelas ini.');
        }
        
        // Precheck kapasitas (quick check sebelum masuk queue)
        $joinedCount = $class->bookings()->count();
        if ($joinedCount >= (int)$class->kapasitas) {
            return back()->with('error', 'Kelas sudah penuh!');
        }

        // Dispatch job ke queue untuk proses booking
        ProcessBooking::dispatch($class->class_id, $member->member_id);

        // Tambahkan ke pending session untuk UI feedback
        $pending = session('pending_bookings', []);
        if (!in_array($class->class_id, $pending)) {
            $pending[] = $class->class_id;
            session(['pending_bookings' => $pending]);
        }

        \Log::info('Booking queued successfully', [
            'class_id' => $class->class_id,
            'member_id' => $member->member_id,
        ]);

        return back()->with('success', 'Permintaan bergabung kelas sedang diproses. Silakan tunggu beberapa saat!');
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
