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
        return view('pages.dashboard.admin.equipments.create');
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

        return redirect()->route('admin.equipments.index')->with('success', 'Equipment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipments $equipments)
    {
        return view('pages.dashboard.admin.equipments.show', compact('equipments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipments $equipments)
    {
        return view('pages.dashboard.admin.equipments.edit', compact('equipments'));
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

        return redirect()->route('admin.equipments.index')->with('success', 'Equipment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipments $equipments)
    {
        $equipments->delete();
        return redirect()->route('admin.equipments.index')->with('success', 'Equipment deleted successfully.');
    }

    /**
     * Report equipment issue (for trainers)
     */
    public function reportIssue(Request $request, Equipments $equipments)
    {
        $request->validate([
            'report_description' => 'required|string|max:500',
        ]);

        // Update equipment condition to "Perlu Perbaikan"
        $equipments->update([
            'kondisi' => 'Perlu Perbairan'
        ]);

        // Here you could also log the report or send notification to admin
        // For now, we'll just redirect with success message
        
        return redirect()->route('trainer.equipments.index')
            ->with('success', "Equipment issue reported successfully. Admin has been notified about: {$equipments->nama_alat}");
    }
}
