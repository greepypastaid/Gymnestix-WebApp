<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GymClass;
use App\Models\Trainer;

class GymClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // trainer dapat melihat semua kelas (schedule.view_all)
    $classes = GymClass::with('trainer')->paginate(15);
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
