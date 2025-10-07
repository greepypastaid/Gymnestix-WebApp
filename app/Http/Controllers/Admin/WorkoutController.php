<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkoutProgress;
use App\Models\Member;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('workout.manage');

        $q    = trim($request->get('q', ''));
        $from = $request->get('from');
        $to   = $request->get('to');

        $rows = WorkoutProgress::query()
            ->with(['member.user']) // member->user kalau ada
            ->when($q !== '', function ($qq) use ($q) {
                $qq->where('jenis_latihan', 'like', "%{$q}%")
                   ->orWhereHas('member', function ($m) use ($q) {
                       // Cari di nama member, atau nama/email user (jika relasi ada)
                       $m->where('nama', 'like', "%{$q}%")
                         ->orWhereHas('user', function ($u) use ($q) {
                             $u->where('nama', 'like', "%{$q}%")
                               ->orWhere('email', 'like', "%{$q}%");
                         });
                   });
            })
            ->when($from, fn($qq) => $qq->whereDate('tanggal', '>=', $from))
            ->when($to,   fn($qq) => $qq->whereDate('tanggal', '<=', $to))
            ->orderByDesc('tanggal')
            ->paginate(10)
            ->appends($request->query());

        return view('admin.workout.index', compact('rows','q','from','to'));
    }

    public function create()
    {
        $this->authorize('workout.manage');

        $row = new WorkoutProgress();
        $members = Member::with('user')->orderBy('member_id')->get();
        return view('admin.workout.create', compact('row','members'));
    }

    public function store(Request $request)
    {
        $this->authorize('workout.manage');

        $data = $request->validate([
            'member_id'         => ['required','exists:members,member_id'],
            'tanggal'           => ['required','date'],
            'jenis_latihan'     => ['required','string','max:255'],
            'catatan_repetisi'  => ['nullable','integer','min:0'],
            'catatan_durasi'    => ['nullable','integer','min:0'],
            'catatan_berat'     => ['nullable','numeric','min:0'],
        ]);

        WorkoutProgress::create($data);

        return redirect()->route('admin.workouts.index')->with('ok','Workout progress created.');
    }

    public function edit($id)
    {
        $this->authorize('workout.manage');

        $row = WorkoutProgress::where('progress_id', $id)->firstOrFail();
        $members = Member::with('user')->orderBy('member_id')->get();
        return view('admin.workout.edit', compact('row','members'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('workout.manage');

        $row = WorkoutProgress::where('progress_id', $id)->firstOrFail();

        $data = $request->validate([
            'member_id'         => ['required','exists:members,member_id'],
            'tanggal'           => ['required','date'],
            'jenis_latihan'     => ['required','string','max:255'],
            'catatan_repetisi'  => ['nullable','integer','min:0'],
            'catatan_durasi'    => ['nullable','integer','min:0'],
            'catatan_berat'     => ['nullable','numeric','min:0'],
        ]);

        $row->update($data);

        return redirect()->route('admin.workouts.index')->with('ok','Workout progress updated.');
    }

    public function destroy($id)
    {
        $this->authorize('workout.manage');

        $row = WorkoutProgress::where('progress_id', $id)->firstOrFail();
        $row->delete();

        return redirect()->route('admin.workouts.index')->with('ok','Workout progress deleted.');
    }
}
