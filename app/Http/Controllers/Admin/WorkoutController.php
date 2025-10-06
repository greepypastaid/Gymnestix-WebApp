<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('workout.manage');

        $q     = trim($request->get('q', ''));
        $level = $request->get('level', '');

        $rows = Workout::query()
            ->when($q, fn($qq) =>
                $qq->where(function($w) use ($q) {
                    $w->where('title','like',"%{$q}%")
                      ->orWhere('description','like',"%{$q}%")
                      ->orWhere('equipment_required','like',"%{$q}%");
                })
            )
            ->when($level, fn($qq) => $qq->where('level', $level))
            ->orderBy('title')
            ->paginate(10)
            ->withQueryString();

        return view('admin.workouts.index', compact('rows','q','level'));
    }

    public function create()
    {
        $this->authorize('workout.manage');
        $row = new Workout();
        return view('admin.workouts.create', compact('row'));
    }

    public function store(Request $request)
    {
        $this->authorize('workout.manage');

        $data = $request->validate([
            'title'              => ['required','string','max:255'],
            'level'              => ['required','in:beginner,intermediate,advanced'],
            'duration_minutes'   => ['nullable','integer','min:0'],
            'equipment_required' => ['nullable','string','max:255'],
            'description'        => ['nullable','string'],
        ]);

        // created_by mengikuti PK users = user_id
        $data['created_by'] = Auth::id() ?? optional(Auth::user())->user_id;

        Workout::create($data);

        return redirect()
            ->route('admin.workouts.index')
            ->with('ok', 'Workout created.');
    }

    public function edit(Workout $workout)
    {
        $this->authorize('workout.manage');
        $row = $workout;
        return view('admin.workouts.edit', compact('row'));
    }

    public function update(Request $request, Workout $workout)
    {
        $this->authorize('workout.manage');

        $data = $request->validate([
            'title'              => ['required','string','max:255'],
            'level'              => ['required','in:beginner,intermediate,advanced'],
            'duration_minutes'   => ['nullable','integer','min:0'],
            'equipment_required' => ['nullable','string','max:255'],
            'description'        => ['nullable','string'],
        ]);

        $workout->update($data);

        return redirect()
            ->route('admin.workouts.index')
            ->with('ok', 'Workout updated.');
    }

    public function destroy(Workout $workout)
    {
        $this->authorize('workout.manage');
        $workout->delete();

        return redirect()
            ->route('admin.workouts.index')
            ->with('ok', 'Workout deleted.');
    }
}
