<?php

namespace App\Http\Controllers;

use App\Models\Equipments;
use Illuminate\Http\Request;

class EquipmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $equipments = Equipments::paginate(20);
    return view('pages.dashboard.trainer.equipments.trainerEquipment', compact('equipments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    return view('pages.dashboard.trainer.equipments.trainerCreateEquipment');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kondisi' => 'required|in:Baik,Perlu Perbaikan',
            'tanggal_pembelian' => 'required|date',
            'jadwal_perawatan' => 'required|date',
        ]);

        Equipments::create($data);

        return redirect()->route('pages.dashboard.trainer.equipments.trainerEquipment')->with('success', 'Equipment created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipments $equipments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipments $equipments)
    {
    return view('pages.dashboard.trainer.equipments.trainerEditEquipment', compact('equipments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipments $equipments)
    {
        $data = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kondisi' => 'required|in:Baik,Perlu Perbaikan',
            'tanggal_pembelian' => 'required|date',
            'jadwal_perawatan' => 'required|date',
        ]);

        $equipments->update($data);

        return redirect()->route('pages.dashboard.trainer.equipments.trainerEquipment')->with('success', 'Equipment updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipments $equipments)
    {
        $equipments->delete();
        return redirect()->route('pages.dashboard.trainer.equipments.trainerEquipment')->with('success', 'Equipment deleted.');
    }
}
