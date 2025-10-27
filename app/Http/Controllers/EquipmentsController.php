<?php

namespace App\Http\Controllers;

use App\Models\Equipments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if user is admin or trainer to show different views
        $user = Auth::user();
        
        // Get filter parameters for admin view
        $q = request('q');
        $kondisi = request('kondisi');
        
        // Build query
        $query = Equipments::query();
        
        if ($q) {
            $query->where('nama_alat', 'like', "%{$q}%");
        }
        
        if ($kondisi) {
            $query->where('kondisi', 'like', "%{$kondisi}%");
        }
        
        $equipments = $query->orderBy('nama_alat')->paginate(20);
        
        $routeName = optional(request()->route())->getName();
        if ($routeName && str_starts_with($routeName, 'trainer.')) {
            return view('trainer.equipments.trainerEquipment', compact('equipments'));
        }

        // Otherwise fallback to admin permission check (admin UI)
        $hasViewAllPermission = false;
        if ($user->role) {
            $hasViewAllPermission = $user->role->permissions()->where('name', 'equipment.view_all')->exists();
        }
        
        if ($hasViewAllPermission) {
            return view('trainer.equipments.trainerEquipment', compact('equipments'));
        }
        
        // Default: admin view
        return view('admin.equipment.index', compact('equipments', 'q', 'kondisi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.equipment.create');
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

        return redirect()->route('admin.equipment.index')->with('success', 'Equipment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipments $equipments)
    {
        return view('admin.equipment.show', compact('equipments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipments $equipments)
    {
        return view('admin.equipment.edit', compact('equipments'));
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

        return redirect()->route('admin.equipment.index')->with('success', 'Equipment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipments $equipments)
    {
        $equipments->delete();
        return redirect()->route('admin.equipment.index')->with('success', 'Equipment deleted successfully.');
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
            'kondisi' => 'Perlu Perbaikan'
        ]);

        // Here you could also log the report or send notification to admin
        // For now, we'll just redirect with success message
        
        return redirect()->route('trainer.equipments.index')
            ->with('success', "Equipment issue reported successfully. Admin has been notified about: {$equipments->nama_alat}");
    }
}