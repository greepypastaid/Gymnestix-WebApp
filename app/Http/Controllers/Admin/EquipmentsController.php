<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipments;
use Illuminate\Http\Request;

class EquipmentsController extends Controller
{
    public function index(Request $request)
    {
        // Tes: uncomment baris di bawah untuk memastikan route masuk ke sini
        // dd('hit equipment index');

        $q        = trim($request->get('q', ''));
        $kondisi  = trim($request->get('kondisi', ''));
        $dateFrom = $request->get('from');
        $dateTo   = $request->get('to');

        $rows = Equipments::query()
            ->withCount('peminjamans')
            ->when($q !== '', fn($qq) => $qq->where('nama_alat', 'like', "%{$q}%"))
            ->when($kondisi !== '', fn($qq) => $qq->where('kondisi', 'like', "%{$kondisi}%"))
            ->when($dateFrom, fn($qq) => $qq->whereDate('tanggal_pembelian', '>=', $dateFrom))
            ->when($dateTo,   fn($qq) => $qq->whereDate('tanggal_pembelian', '<=', $dateTo))
            ->orderBy('nama_alat')
            ->paginate(10)
            ->appends($request->query());

        return view('admin.equipment.index', compact('rows','q','kondisi','dateFrom','dateTo'));
    }

    public function create()
    {
        $this->authorize('equipment.manage');
        $row = new Equipments();
        return view('admin.equipment.create', compact('row'));
    }

    public function store(Request $request)
    {
        $this->authorize('equipment.manage');

        $data = $request->validate([
            'nama_alat'         => ['required','string','max:255'],
            'kondisi'           => ['required','string','max:100'],
            'tanggal_pembelian' => ['nullable','date'],
            'jadwal_perawatan'  => ['nullable','date'],
        ]);

        Equipments::create($data);
        return redirect()->route('admin.equipment.index')->with('ok','Equipment created.');
    }

    public function edit($id)
    {
        $this->authorize('equipment.manage');
        $row = Equipments::where('equipment_id', $id)->firstOrFail();
        return view('admin.equipment.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('equipment.manage');
        $row = Equipments::where('equipment_id', $id)->firstOrFail();

        $data = $request->validate([
            'nama_alat'         => ['required','string','max:255'],
            'kondisi'           => ['required','string','max:100'],
            'tanggal_pembelian' => ['nullable','date'],
            'jadwal_perawatan'  => ['nullable','date'],
        ]);

        $row->update($data);
        return redirect()->route('admin.equipment.index')->with('ok','Equipment updated.');
    }

    public function destroy($id)
    {
        $this->authorize('equipment.manage');
        $row = Equipments::where('equipment_id', $id)->firstOrFail();
        $row->delete();

        return redirect()->route('admin.equipment.index')->with('ok','Equipment deleted.');
    }
}
