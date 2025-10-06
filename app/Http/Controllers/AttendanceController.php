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

        $data = $request->validate([
            'member_id' => 'required|integer',
            'tanggal' => 'required|date',
            'status' => 'required|string',
            'waktu_masuk' => 'nullable|date_format:H:i:s',
            'waktu_keluar' => 'nullable|date_format:H:i:s',
            'durasi_latihan' => 'nullable|integer',
            'catatan' => 'nullable|string',
        ]);

        $data['class_id'] = $class->class_id;
        $data['trainer_id'] = $class->trainer_id;

        // create or update today's attendance for that member+class
        Attendance::updateOrCreate(
            [
                'member_id' => $data['member_id'],
                'class_id' => $data['class_id'],
                'tanggal' => $data['tanggal'],
            ],
            $data
        );

        return redirect()->back()->with('success', 'Attendance saved.');
    }
}
