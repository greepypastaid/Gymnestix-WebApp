<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\GymClass;
use App\Models\Trainer;

class GymClassController extends Controller
{
    /**
     * Display the members of a specific class
     */
    public function viewMembers(GymClass $gymClass)
    {
        $this->authorizeOwnership($gymClass, request());

        $members = $gymClass->bookings()
            ->with(['member.user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('trainer.class.members', [
            'class' => $gymClass,
            'members' => $members
        ]);
    }

    /**
     * Display a listing of the resource for trainer.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Require trainer role
        $trainer = $user->trainer;
        if (!$trainer) {
            abort(403, 'Anda bukan trainer.');
        }

        // Show only classes owned by this trainer
        $classes = GymClass::with('trainer.user')
            ->where('trainer_id', $trainer->trainer_id)
            ->paginate(15);

        return view('trainer.class.trainerClass', compact('classes'));
    }

    /**
     * Show the form for creating a new resource for trainer.
     */
    public function create(Request $request)
    {
        $user = $request->user();
        if (!$user->isTrainer()) { abort(403, 'Anda bukan trainer.'); }

        return view('trainer.class.createTrainerClass');
    }

    /**
     * Store a newly created resource in storage for trainer.
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'durasi' => 'required|integer',
            'kapasitas' => 'required|integer',
        ]);

        // Set trainer_id to current trainer
        $trainer = $user->trainer;
        if (!$trainer) {
            abort(403, 'Anda bukan trainer.');
        }

        $data = $request->only(['nama_kelas','deskripsi','waktu_mulai','waktu_selesai','durasi','kapasitas']);
        $data['trainer_id'] = $trainer->trainer_id;

        GymClass::create($data);

        return redirect()->route('trainer.classes.index')->with('success','Kelas dibuat.');
    }

    /**
     * Ensure the current user can manage/view this class (trainer only).
     * aborts with 403 if unauthorized.
     */
    protected function authorizeOwnership(GymClass $gymClass, Request $request)
    {
        $user = $request->user();

        $trainer = $user->trainer;
        if (!$trainer || $gymClass->trainer_id !== $trainer->trainer_id) {
            abort(403, 'You do not own this class.');
        }
    }

    /**
     * Show the form for editing the specified resource for trainer.
     */
    public function edit(GymClass $gymClass, Request $request)
    {
        $this->authorizeOwnership($gymClass, $request);

        // changed view path:
        return view('trainer.class.editTrainerClass', compact('gymClass'));
    }

    /**
     * Update the specified resource in storage for trainer.
     */
    public function update(Request $request, GymClass $gymClass)
    {
        $this->authorizeOwnership($gymClass, $request);

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'durasi' => 'required|integer',
            'kapasitas' => 'required|integer',
        ]);

        $gymClass->update($request->only(['nama_kelas','deskripsi','waktu_mulai','waktu_selesai','durasi','kapasitas']));

        return redirect()->route('trainer.classes.index')->with('success','Kelas diperbarui.');
    }

    /**
     * Remove the specified resource from storage for trainer.
     */
    public function destroy(GymClass $gymClass, Request $request)
    {
        $this->authorizeOwnership($gymClass, $request);
        $gymClass->delete();

        return redirect()->route('trainer.classes.index')->with('success','Kelas dihapus.');
    }

    /**
     * Display the specified resource for trainer.
     */
    public function show(GymClass $gymClass)
    {
        // Ensure user can view this class (must be owner trainer)
        $this->authorizeOwnership($gymClass, request());

        // Show trainer-specific detail view
        return view('pages.dashboard.trainer.class.show', compact('gymClass'));
    }
}
