<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkoutProgress;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutController extends Controller
{
    public function index(Request $request)
    {
        abort_if(
            !optional(Auth::user())->hasPermission('workout.manage'),
            403,
            'Unauthorized to manage workouts.'
        );

        $search = $request->get('search', '');
        $memberId = $request->get('member_id', '');

        $workouts = WorkoutProgress::with(['member.user'])
            ->when($search, function($q) use ($search) {
                $q->where('jenis_latihan', 'like', "%{$search}%")
                  ->orWhereHas('member.user', function($qu) use ($search) {
                      $qu->where('nama', 'like', "%{$search}%");
                  });
            })
            ->when($memberId, fn($q) => $q->where('member_id', $memberId))
            ->orderByDesc('tanggal')
            ->paginate(15)
            ->withQueryString();

        return view('admin.workouts.index', compact('workouts', 'search', 'memberId'));
    }

    public function show($memberId)
    {
        abort_if(!optional(Auth::user())->hasPermission('workout.manage'), 403);

        $member = Member::with('user')->findOrFail($memberId);
        
        $progresses = WorkoutProgress::where('member_id', $memberId)
            ->orderByDesc('tanggal')
            ->paginate(20);

        return view('admin.workouts.show', compact('member', 'progresses'));
    }

    public function destroy($progressId)
    {
        abort_if(!optional(Auth::user())->hasPermission('workout.manage'), 403);
        
        $progress = WorkoutProgress::findOrFail($progressId);
        $progress->delete();

        return back()->with('success', 'Workout progress deleted.');
    }
}
