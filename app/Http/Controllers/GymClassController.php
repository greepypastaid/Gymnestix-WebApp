<?php

namespace App\Http\Controllers;

use App\Models\GymClass;
use Illuminate\Http\Request;

class GymClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = \App\Models\GymClass::with(['trainer.user'])->get();
        return view('gym_class.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gym_class.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'trainer_id' => 'required|exists:trainers,trainer_id',
            'nama_kelas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'durasi' => 'required|integer',
            'kapasitas' => 'required|integer',
        ]);
        \App\Models\GymClass::create($validated);
        return redirect()->route('gym_class.index')->with('success', 'Jadwal kelas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(GymClass $gymClass)
    {
        return view('gym_class.show', compact('gymClass'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GymClass $gymClass)
    {
        return view('gym_class.edit', compact('gymClass'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GymClass $gymClass)
    {
        $validated = $request->validate([
            'trainer_id' => 'required|exists:trainers,trainer_id',
            'nama_kelas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'durasi' => 'required|integer',
            'kapasitas' => 'required|integer',
        ]);
        $gymClass->update($validated);
        return redirect()->route('gym_class.index')->with('success', 'Jadwal kelas berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymClass $gymClass)
    {
        $gymClass->delete();
        return redirect()->route('gym_class.index')->with('success', 'Jadwal kelas berhasil dihapus!');
    }
}
