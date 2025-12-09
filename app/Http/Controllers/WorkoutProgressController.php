<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\WorkoutProgress;
use Illuminate\Http\Request;

class WorkoutProgressController extends Controller
{
    /**
     * Display a listing of workout progress (Admin)
     */
    public function index(Request $request)
    {
        // sesuaikan data jika perlu, untuk sekarang tampilkan view placeholder
        return view('admin.workout.index');
    }

    public function create()
    {
        return view('admin.workout.create');
    }

    public function store(Request $request)
    {
        // implementasi sesuai kebutuhan
        return redirect()->route('admin.workout.index')->with('success', 'Workout saved (placeholder).');
    }

    public function show($id)
    {
        return view('admin.workout.show', compact('id'));
    }

    public function edit($id)
    {
        return view('admin.workout.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // implementasi
        return redirect()->route('admin.workout.index')->with('success', 'Workout updated (placeholder).');
    }

    public function destroy($id)
    {
        // implementasi
        return redirect()->route('admin.workout.index')->with('success', 'Workout deleted (placeholder).');
    }

    public function indexForMember(Member $member, Request $request)
    {
        $query = WorkoutProgress::where('member_id', $member->member_id);

        // Add search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('jenis_latihan', 'LIKE', "%{$search}%")
                  ->orWhere('catatan', 'LIKE', "%{$search}%")
                  ->orWhere('tanggal', 'LIKE', "%{$search}%");
            });
        }

        $progresses = $query->orderByDesc('tanggal')->paginate(10)->withQueryString();

        return view('trainer.workout.trainerViewWorkout', compact('member', 'progresses'));
    }
}
