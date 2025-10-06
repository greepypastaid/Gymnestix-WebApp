<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\GymClass;
use App\Models\Trainer;

class GymClassController extends Controller
{
    /**
     * Display a listing of gym classes for admin
     */
    public function index(Request $request)
    {
        // Only admin with schedule.view_all permission
        if (!Gate::allows('schedule.view_all') && !($request->user()->hasPermission('schedule.view_all') ?? false)) {
            abort(403, 'Unauthorized access.');
        }

        $classes = GymClass::with(['trainer.user'])->paginate(15);
        return view('gym_class.index', compact('classes'));
    }

    /**
     * Show the form for creating a new gym class
     */
    public function create(Request $request)
    {
        if (!Gate::allows('schedule.assign_trainer')) {
            abort(403);
        }

        $trainers = Trainer::with('user')->get();
        return view('gym_class.create', compact('trainers'));
    }

    /**
     * Store a newly created gym class
     */
    public function store(Request $request)
    {
        if (!Gate::allows('schedule.assign_trainer')) {
            abort(403);
        }

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'durasi' => 'required|integer',
            'kapasitas' => 'required|integer',
            'trainer_id' => 'required|exists:trainers,trainer_id',
        ]);

        $data = $request->only(['nama_kelas','deskripsi','waktu_mulai','waktu_selesai','durasi','kapasitas','trainer_id']);

        GymClass::create($data);

        return redirect()->route('gym_class.index')->with('success', 'Jadwal kelas berhasil ditambahkan!');
    }

    /**
     * Display the specified gym class
     */
    public function show(GymClass $gymClass, Request $request)
    {
        if (!Gate::allows('schedule.view_all') && !($request->user()->hasPermission('schedule.view_all') ?? false)) {
            abort(403);
        }

        return view('gym_class.show', compact('gymClass'));
    }

    /**
     * Show the form for editing the specified gym class
     */
    public function edit(GymClass $gymClass, Request $request)
    {
        if (!Gate::allows('schedule.view_all') && !($request->user()->hasPermission('schedule.view_all') ?? false)) {
            abort(403);
        }

        $trainers = Trainer::with('user')->get();
        return view('gym_class.edit', compact('gymClass', 'trainers'));
    }

    /**
     * Update the specified gym class
     */
    public function update(Request $request, GymClass $gymClass)
    {
        if (!Gate::allows('schedule.view_all') && !($request->user()->hasPermission('schedule.view_all') ?? false)) {
            abort(403);
        }

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'durasi' => 'required|integer',
            'kapasitas' => 'required|integer',
            'trainer_id' => 'required|exists:trainers,trainer_id',
        ]);

        $gymClass->update($request->only(['nama_kelas','deskripsi','waktu_mulai','waktu_selesai','durasi','kapasitas','trainer_id']));

        return redirect()->route('gym_class.index')->with('success', 'Kelas diperbarui.');
    }

    /**
     * Remove the specified gym class
     */
    public function destroy(GymClass $gymClass, Request $request)
    {
        if (!Gate::allows('schedule.view_all') && !($request->user()->hasPermission('schedule.view_all') ?? false)) {
            abort(403);
        }

        $gymClass->delete();

        return redirect()->route('gym_class.index')->with('success', 'Kelas dihapus.');
    }

    /**
     * Display the members of a specific class
     */
    public function viewMembers(GymClass $gymClass, Request $request)
    {
        if (!Gate::allows('schedule.view_all') && !($request->user()->hasPermission('schedule.view_all') ?? false)) {
            abort(403);
        }

        $members = $gymClass->bookings()
            ->with(['member.user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gym_class.members', [
            'class' => $gymClass,
            'members' => $members
        ]);
    }
}
