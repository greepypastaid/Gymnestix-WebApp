<?php

namespace App\Http\Controllers;

use App\Models\MembershipPlan;
use Illuminate\Http\Request;

class MembershipPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
        {
            $plans = MembershipPlan::all();
            return view('membership_plan.index', compact('plans'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
        {
            return view('membership_plan.create');
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {
            $validated = $request->validate([
                'nama_plan' => 'required|string|max:255',
                'harga' => 'required|numeric',
                'periode_bulan' => 'required|integer',
                'deskripsi' => 'nullable|string',
            ]);
            MembershipPlan::create($validated);
            return redirect()->route('membership_plan.index')->with('success', 'Membership plan berhasil ditambahkan');
        }

    /**
     * Display the specified resource.
     */
    public function show(MembershipPlan $membershipPlan)
        {
            return view('membership_plan.show', ['plan' => $membershipPlan]);
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MembershipPlan $membershipPlan)
        {
            return view('membership_plan.edit', ['plan' => $membershipPlan]);
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MembershipPlan $membershipPlan)
        {
            $validated = $request->validate([
                'nama_plan' => 'required|string|max:255',
                'harga' => 'required|numeric',
                'periode_bulan' => 'required|integer',
                'deskripsi' => 'nullable|string',
            ]);
            $membershipPlan->update($validated);
            return redirect()->route('membership_plan.index')->with('success', 'Membership plan berhasil diupdate');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MembershipPlan $membershipPlan)
        {
            $membershipPlan->delete();
            return redirect()->route('membership_plan.index')->with('success', 'Membership plan berhasil dihapus');
        }
}
