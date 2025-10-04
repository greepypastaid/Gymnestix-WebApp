<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GymClass;
use App\Models\Trainer;

class GymClassController extends Controller
{
    /**
     * Display the members of a specific class
     */
    public function viewMembers(GymClass $gymClass)
    {
        $user = request()->user();
        $trainer = $user->trainer;

        // Ensure the user is a trainer
        if (!$user->isTrainer()) {
            abort(403, 'Only trainers can view class members.');
        }

        // Check if user has permission to view all schedules or is the class owner
        if (!$user->hasPermission('schedule.view_all') && (!$trainer || $gymClass->trainer_id !== $trainer->trainer_id)) {
            abort(403, 'You are not authorized to view members of this class.');
        }

        $members = $gymClass->bookings()
            ->with(['member' => function($query) {
                $query->with('user'); // Include user details
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.dashboard.trainer.class.members', [
            'class' => $gymClass,
            'members' => $members
        ]);

        // Get class members with their details and booking information
        $members = $gymClass->bookings()
            ->with(['member' => function($query) {
                $query->with('user'); // Include user details
            }])
            ->where('status', 'confirmed')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.dashboard.trainer.class.members', [
            'class' => $gymClass,
            'members' => $members
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $user = $request->user();

        // Only show classes owned by the authenticated trainer
        $trainer = $user->trainer;
        if (!$trainer) {
            // not a trainer
            abort(403, 'Anda bukan trainer.');
        }

        $classes = GymClass::with('trainer')
            ->where('trainer_id', $trainer->trainer_id)
            ->paginate(15);

        return view('pages.dashboard.trainer.class.trainerClass', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // form buat kelas (trainer hanya membuat untuk dirinya sendiri)
    return view('pages.dashboard.trainer.class.createTrainerClass');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'durasi' => 'required|integer',
            'kapasitas' => 'required|integer',
        ]);

        /** ambil trainer_id dari user yang sedang login */
        $trainer = $request->user()->trainer;
        if (!$trainer) {
            abort(403, 'Anda bukan trainer.');
        }

        $data = $request->only(['nama_kelas','deskripsi','waktu_mulai','waktu_selesai','durasi','kapasitas']);
        $data['trainer_id'] = $trainer->trainer_id;

        GymClass::create($data);

        return redirect()->route('trainer.classes.index')->with('success','Kelas dibuat.');
    }

    protected function authorizeOwnership(GymClass $gymClass, Request $request)
    {
        $trainer = $request->user()->trainer;
        if (!$trainer || $gymClass->trainer_id !== $trainer->trainer_id) {
            abort(403, 'You do not own this class.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GymClass $gymClass, Request $request)
    {
        $this->authorizeOwnership($gymClass, $request);
    return view('pages.dashboard.trainer.class.editTrainerClass', compact('gymClass'));
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(GymClass $gymClass, Request $request)
    {
        $this->authorizeOwnership($gymClass, $request);
        $gymClass->delete();
        return redirect()->route('trainer.classes.index')->with('success','Kelas dihapus.');
    }
}
