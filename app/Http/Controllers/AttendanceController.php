<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Member;
use App\Models\GymClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function selectClass()
    {
        // Get all active classes taught by the logged-in trainer with booking counts
        $classes = GymClass::where('trainer_id', Auth::id())
            ->withCount('bookings')
            ->orderBy('waktu_mulai')
            ->orderBy('nama_kelas')
            ->get();
        
        return view('pages.dashboard.trainer.attendance.select_class', compact('classes'));
    }

    public function track(GymClass $class)
    {
        // Validate if this class belongs to the logged-in trainer
        if ($class->trainer_id !== Auth::id()) {
            abort(403, 'You are not authorized to take attendance for this class.');
        }

        // Check if the class has any bookings
        $bookingCount = $class->bookings()->count();
        if ($bookingCount === 0) {
            return redirect()->route('trainer.attendance.select-class')
                ->with('error', "No members are currently enrolled in {$class->nama_kelas}. Please check class enrollments first.");
        }

        // Get all enrolled members for this class, including those who might already have attendance
        $members = Member::with(['user', 'attendances' => function ($query) use ($class) {
            $query->where('tanggal', now()->toDateString())
                  ->where('class_id', $class->class_id);
        }])
        ->whereHas('bookings', function ($query) use ($class) {
            $query->where('class_id', $class->class_id);
        })
        ->get();

        // Double-check if we got any members (shouldn't happen due to earlier check, but just in case)
        if ($members->isEmpty()) {
            return redirect()->route('trainer.attendance.select-class')
                ->with('error', "Unable to retrieve member data for {$class->nama_kelas}. Please try again.");
        }

        return view('pages.dashboard.trainer.attendance.track', compact('members', 'class'));
    }

    public function store(Request $request, GymClass $class)
    {
        // Validate if this class belongs to the logged-in trainer
        if ($class->trainer_id !== Auth::id()) {
            abort(403, 'You are not authorized to take attendance for this class.');
        }

        $validated = $request->validate([
            'attendance' => 'required|array',
            'attendance.*' => 'required|in:hadir,izin,sakit,alpa',
            'notes' => 'array',
            'notes.*' => 'nullable|string',
            'general_notes' => 'nullable|string',
        ]);

        // Begin transaction
        DB::beginTransaction();
        try {
            foreach ($validated['attendance'] as $memberId => $status) {
                // Create or update attendance record
                Attendance::updateOrCreate(
                    [
                        'member_id' => $memberId,
                        'class_id' => $class->class_id,
                        'tanggal' => now()->toDateString(),
                    ],
                    [
                        'trainer_id' => Auth::id(),
                        'waktu_masuk' => $class->waktu_mulai,
                        'waktu_keluar' => $class->waktu_selesai,
                        'durasi_latihan' => $class->durasi,
                        'status' => $status,
                        'catatan' => $validated['notes'][$memberId] ?? $validated['general_notes'] ?? null,
                    ]
                );
            }
            DB::commit();
            return back()->with('success', 'Attendance recorded successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to record attendance. Please try again.');
        }
    }

    public function viewAll()
    {
        // Get attendance records for classes taught by the logged-in trainer
        $attendances = Attendance::with(['member.user', 'trainer', 'class'])
            ->whereHas('class', function ($query) {
                $query->where('trainer_id', Auth::id());
            })
            ->orderByDesc('tanggal')
            ->orderBy('class_id')
            ->get();
            
        return view('pages.dashboard.trainer.attendance.view_all', compact('attendances'));
    }
}
