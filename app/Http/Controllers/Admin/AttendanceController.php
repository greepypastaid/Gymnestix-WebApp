<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\ClassSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AttendanceController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        $date = $request->get('date');      // yyyy-mm-dd
        $q    = $request->get('q');         // cari nama/email
        $status = $request->get('status');  // present/absent/late

        $attendances = Attendance::with(['user','schedule'])
            ->when($date, fn($qb) => $qb->whereDate('attendance_date', $date))
            ->when($status, fn($qb) => $qb->where('status', $status))
            ->when($q, function($qb) use ($q){
                $qb->whereHas('user', function($uq) use ($q){
                    $uq->where('nama','like',"%$q%")
                       ->orWhere('email','like',"%$q%");
                });
            })
            ->orderByDesc('attendance_date')
            ->orderBy('check_in_at')
            ->paginate(12)->withQueryString();

        return view('admin.attendance.index', compact('attendances','date','q','status'));
    }

    public function create()
    {
        // daftar member: user dengan role 'member'
        $members = User::whereHas('role', fn($r)=>$r->where('name','member'))
                       ->orderBy('nama')->get(['user_id','nama','email']);

        $schedules = ClassSchedule::orderByDesc('class_date')
                     ->orderBy('start_time')->limit(100)->get(['id','class_name','class_date','start_time','end_time']);

        return view('admin.attendance.create', compact('members','schedules'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'          => ['required','exists:users,user_id'],
            'attendance_date'  => ['required','date'],
            'class_schedule_id'=> ['nullable','exists:class_schedules,id'],
            'check_in_at'      => ['nullable','date'],
            'check_out_at'     => ['nullable','date','after_or_equal:check_in_at'],
            'status'           => ['required','in:present,absent,late'],
            'notes'            => ['nullable','string','max:500'],
        ]);

        $data['recorded_by'] = $request->user()->user_id ?? null;

        Attendance::create($data);

        return redirect()->route('admin.attendance.index')->with('ok','Attendance recorded.');
    }

    public function edit(Attendance $attendance)
    {
        $members = User::whereHas('role', fn($r)=>$r->where('name','member'))
                       ->orderBy('nama')->get(['user_id','nama','email']);
        $schedules = ClassSchedule::orderByDesc('class_date')
                     ->orderBy('start_time')->limit(100)->get(['id','class_name','class_date','start_time','end_time']);

        return view('admin.attendance.edit', compact('attendance','members','schedules'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $data = $request->validate([
            'user_id'          => ['required','exists:users,user_id'],
            'attendance_date'  => ['required','date'],
            'class_schedule_id'=> ['nullable','exists:class_schedules,id'],
            'check_in_at'      => ['nullable','date'],
            'check_out_at'     => ['nullable','date','after_or_equal:check_in_at'],
            'status'           => ['required','in:present,absent,late'],
            'notes'            => ['nullable','string','max:500'],
        ]);

        $data['recorded_by'] = $request->user()->user_id ?? null;

        $attendance->update($data);

        return redirect()->route('admin.attendance.index')->with('ok','Attendance updated.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return back()->with('ok','Attendance deleted.');
    }
}
