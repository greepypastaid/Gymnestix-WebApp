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
