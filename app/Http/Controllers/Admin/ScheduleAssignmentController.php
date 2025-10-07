<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\ClassSchedule;
use App\Models\TrainerAssignment;
use App\Models\User;

class ScheduleAssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            abort_unless(Gate::allows('schedule.assign_trainer'), 403);
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $q = $request->get('q');
        $schedules = ClassSchedule::when($q, function($query) use ($q) {
                $query->where('class_name', 'like', "%$q%")
                      ->orWhere('room', 'like', "%$q%");
            })
            ->orderByDesc('class_date')
            ->orderBy('start_time')
            ->paginate(10)
            ->withQueryString();

        return view('admin.schedule-assignments.index', compact('schedules', 'q'));
    }

    public function create()
    {
        return view('admin.schedule-assignments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'class_name' => ['required','string','max:120'],
            'class_date' => ['required','date'],
            'start_time' => ['required','date_format:H:i'],
            'end_time'   => ['required','date_format:H:i','after:start_time'],
            'room'       => ['nullable','string','max:60'],
        ]);

        ClassSchedule::create($data);
        return redirect()->route('admin.assignments.index')->with('ok', 'Schedule created.');
    }

    public function edit(ClassSchedule $schedule)
    {
        $trainers = User::whereHas('role', fn($q) => $q->where('name', 'trainer'))
                        ->orderBy('nama')
                        ->get(['user_id', 'nama']);
        $assignment = TrainerAssignment::where('class_schedule_id', $schedule->id)->first();
        return view('admin.schedule-assignments.edit', compact('schedule','trainers','assignment'));
    }

    public function update(Request $request, ClassSchedule $schedule)
    {
        $data = $request->validate([
            'class_name' => ['required','string','max:120'],
            'class_date' => ['required','date'],
            'start_time' => ['required','date_format:H:i'],
            'end_time'   => ['required','date_format:H:i','after:start_time'],
            'room'       => ['nullable','string','max:60'],
            // assignment fields (opsional)
            // sesuaikan exists ke kolom PK project: users.user_id
            'trainer_id' => ['nullable','exists:users,user_id'],
            'notes'      => ['nullable','string','max:500'],
        ]);

        $schedule->update($data);

        // Simpan/ubah penugasan pelatih (satu pelatih per jadwal)
        if ($request->filled('trainer_id')) {
            TrainerAssignment::updateOrCreate(
                ['class_schedule_id' => $schedule->id],
                [
                    'trainer_id' => $request->trainer_id,
                    // gunakan user()->user_id karena primary key user adalah user_id
                    'assigned_by' => $request->user()->user_id,
                    'notes' => $request->notes,
                ]
            );
        } else {
            TrainerAssignment::where('class_schedule_id', $schedule->id)->delete();
        }

        return back()->with('ok','Schedule & assignment updated.');
    }

    public function destroy(ClassSchedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.assignments.index')->with('ok','Schedule deleted.');
    }
}
