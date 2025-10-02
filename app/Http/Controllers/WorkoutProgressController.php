<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\WorkoutProgress;
use Illuminate\Http\Request;

class WorkoutProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkoutProgress $workoutProgress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkoutProgress $workoutProgress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkoutProgress $workoutProgress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkoutProgress $workoutProgress)
    {
        //
    }
    
    public function indexForMember(Member $member)
    {
        // middleware permission: workout.view_member (routes sudah pakai)
        $progresses = WorkoutProgress::where('member_id', $member->member_id)->orderByDesc('tanggal')->get();
        return view('trainer.members.workouts.index', compact('member','progresses'));
    }
}
