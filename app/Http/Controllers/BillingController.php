<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $billings = Billing::with(['member', 'membershipPlan'])->get();
        return view('billing.index', compact('billings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $members = \App\Models\Member::with('user')->get();
        $plans = \App\Models\MembershipPlan::all();
        return view('billing.create', compact('members', 'plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {
            $data = $request->all();
            // Konversi tanggal dari dd/mm/yyyy ke Y-m-d
            if(isset($data['tanggal_tagihan'])) {
                $data['tanggal_tagihan'] = \DateTime::createFromFormat('d/m/Y', $data['tanggal_tagihan']) ? \DateTime::createFromFormat('d/m/Y', $data['tanggal_tagihan'])->format('Y-m-d') : $data['tanggal_tagihan'];
            }
            if(isset($data['tanggal_jatuh_tempo'])) {
                $data['tanggal_jatuh_tempo'] = \DateTime::createFromFormat('d/m/Y', $data['tanggal_jatuh_tempo']) ? \DateTime::createFromFormat('d/m/Y', $data['tanggal_jatuh_tempo'])->format('Y-m-d') : $data['tanggal_jatuh_tempo'];
            }
            $validated = Validator::make($data, [
                'member_id' => 'required|integer',
                'plan_id' => 'required|integer',
                'jumlah' => 'required|numeric',
                'tanggal_tagihan' => 'required|date',
                'tanggal_jatuh_tempo' => 'required|date',
                'status_pembayaran' => 'required|string',
            ])->validate();
            Billing::create($validated);
            return redirect()->route('billing.index')->with('success', 'Pembayaran berhasil ditambahkan');
        }

    /**
     * Display the specified resource.
     */
    public function show(Billing $billing)
        {
            return view('billing.show', compact('billing'));
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Billing $billing)
    {
        $members = \App\Models\Member::all();
        $plans = \App\Models\MembershipPlan::all();
        return view('billing.edit', compact('billing', 'members', 'plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Billing $billing)
        {
            $data = $request->all();
            // Konversi tanggal dari dd/mm/yyyy ke Y-m-d
            if(isset($data['tanggal_tagihan'])) {
                $data['tanggal_tagihan'] = \DateTime::createFromFormat('d/m/Y', $data['tanggal_tagihan']) ? \DateTime::createFromFormat('d/m/Y', $data['tanggal_tagihan'])->format('Y-m-d') : $data['tanggal_tagihan'];
            }
            if(isset($data['tanggal_jatuh_tempo'])) {
                $data['tanggal_jatuh_tempo'] = \DateTime::createFromFormat('d/m/Y', $data['tanggal_jatuh_tempo']) ? \DateTime::createFromFormat('d/m/Y', $data['tanggal_jatuh_tempo'])->format('Y-m-d') : $data['tanggal_jatuh_tempo'];
            }
            $validated = Validator::make($data, [
                'member_id' => 'required|integer',
                'plan_id' => 'required|integer',
                'jumlah' => 'required|numeric',
                'tanggal_tagihan' => 'required|date',
                'tanggal_jatuh_tempo' => 'required|date',
                'status_pembayaran' => 'required|string',
            ])->validate();
            $billing->update($validated);
            return redirect()->route('billing.index')->with('success', 'Pembayaran berhasil diupdate');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Billing $billing)
        {
            $billing->delete();
            return redirect()->route('billing.index')->with('success', 'Pembayaran berhasil dihapus');
        }
}
