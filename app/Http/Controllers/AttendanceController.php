<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\GymClass;

class AttendanceController extends Controller
{
    /**
     * List attendances.
     * Admin/manager: all records.
     * Trainer: records for classes the trainer owns only.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Admins / roles with 'attendance.view_all' can see everything
        if (Gate::allows('attendance.view_all') || Gate::allows('schedule.view_all')) {
            $attendances = Attendance::with(['member.user', 'trainer', 'class'])
                ->orderByDesc('tanggal')
                ->paginate(25);

            return view('admin.attendance.index', compact('attendances'));
        }

        // Otherwise the user must be a trainer and can only see attendances for their classes
        $trainer = $user->trainer;
        if (!$trainer) {
            abort(403, 'Anda tidak memiliki akses melihat attendance.');
        }

        $classIds = GymClass::where('trainer_id', $trainer->trainer_id)->pluck('class_id');

        $attendances = Attendance::with(['member.user', 'trainer', 'class'])
            ->whereIn('class_id', $classIds->toArray())
            ->orderByDesc('tanggal')
            ->paginate(25);

        return view('pages.dashboard.trainer.attendance.index', compact('attendances'));
    }

    /**
     * Track attendance for a specific class (trainer view).
     * Enforce that trainer can only track for classes they own.
     */
    public function track(GymClass $class)
    {
        $user = Auth::user();

        // admins can track any class
        if (!Gate::allows('attendance.track') && !Gate::allows('schedule.view_all')) {
            // if user is not admin/manager, ensure they are the class owner
            $trainer = $user->trainer;
            if (!$trainer || $class->trainer_id !== $trainer->trainer_id) {
                abort(403, 'Anda tidak berwenang untuk mengakses kelas ini.');
            }
        }

        // Get members (bookings) and existing attendances for rendering
        $members = $class->bookings()
            ->with(['member.user'])
            ->orderByDesc('created_at')
            ->get();

        $attendancesToday = Attendance::where('class_id', $class->class_id)
            ->whereDate('tanggal', now()->toDateString())
            ->get()
            ->keyBy('member_id'); // easy lookup in view

        return view('pages.dashboard.trainer.attendance.track', [
            'class' => $class,
            'members' => $members,
            'attendancesToday' => $attendancesToday,
        ]);
    }

    /**
     * Store attendance record (example).
     * Must enforce same ownership rules as track/index.
     */
    public function store(Request $request, GymClass $class)
    {
        $user = $request->user();

        // permission/ownership check same as in track()
        if (!Gate::allows('attendance.track') && !Gate::allows('schedule.view_all')) {
            $trainer = $user->trainer;
            if (!$trainer || $class->trainer_id !== $trainer->trainer_id) {
                abort(403, 'Anda tidak berwenang untuk melakukan ini.');
            }
        }

        // Handle bulk attendance submission
        $attendanceData = $request->input('attendance', []);
        
        foreach ($attendanceData as $memberId => $status) {
            Attendance::updateOrCreate(
                [
                    'member_id' => $memberId,
                    'class_id' => $class->class_id,
                    'tanggal' => now()->toDateString(),
                ],
                [
                    'trainer_id' => $class->trainer_id,
                    'status' => $status,
                    'waktu_masuk' => now()->format('H:i:s'),
                    'waktu_keluar' => now()->addHours(1)->format('H:i:s'),
                ]
            );
        }

        return redirect()->route('trainer.attendance.view_all')->with('success', 'Attendance saved successfully.');
    }

    /**
     * Select class page for trainers to choose which class to track attendance for.
     * Trainers can only see their own classes.
     */
    public function selectClass(Request $request)
    {
        $user = $request->user();

        // Admin can see all classes
        if (Gate::allows('schedule.view_all')) {
            $classes = GymClass::with('trainer')->orderBy('nama_kelas')->get();
        } else {
            // Trainers only see their own classes
            $trainer = $user->trainer;
            if (!$trainer) {
                abort(403, 'Anda tidak memiliki akses untuk tracking attendance.');
            }
            $classes = GymClass::where('trainer_id', $trainer->trainer_id)
                ->orderBy('nama_kelas')
                ->get();
        }

        return view('pages.dashboard.trainer.attendance.select_class', compact('classes'));
    }

    /**
     * View all attendance records.
     * Admin sees all, trainers see only their classes' attendance.
     */
    public function viewAll(Request $request)
    {
        $user = $request->user();

        // Admin/manager can see all attendance records
        if (Gate::allows('attendance.view_all') || Gate::allows('schedule.view_all')) {
            $attendances = Attendance::with(['member.user', 'trainer', 'class'])
                ->orderByDesc('tanggal')
                ->paginate(25);
        } else {
            // Trainers only see attendance for their own classes
            $trainer = $user->trainer;
            if (!$trainer) {
                abort(403, 'Anda tidak memiliki akses melihat attendance.');
            }

            $classIds = GymClass::where('trainer_id', $trainer->trainer_id)->pluck('class_id');

            $attendances = Attendance::with(['member.user', 'trainer', 'class'])
                ->whereIn('class_id', $classIds->toArray())
                ->orderByDesc('tanggal')
                ->paginate(25);
        }

        return view('pages.dashboard.trainer.attendance.view_all', compact('attendances'));
    }
}
