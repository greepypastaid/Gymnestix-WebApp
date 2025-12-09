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
        if (!Gate::allows('schedule.view_all') && !($request->user()->hasPermission('schedule.view_all') ?? false)) {
            abort(403, 'Unauthorized access.');
        }

        $query = GymClass::with(['trainer.user'])->withCount('bookings');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_kelas', 'LIKE', "%{$search}%")
                  ->orWhere('hari', 'LIKE', "%{$search}%")
                  ->orWhere('ruangan', 'LIKE', "%{$search}%")
                  ->orWhereHas('trainer.user', function($q) use ($search) {
                      $q->where('nama', 'LIKE', "%{$search}%");
                  });
            });
        }

        $classes = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

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
        file_put_contents(storage_path('admin_store_called.txt'), 'Admin GymClassController::store() called at ' . now() . "\nData: " . json_encode($request->all(), JSON_PRETTY_PRINT));
        if (!Gate::allows('schedule.assign_trainer')) {
            abort(403);
        }

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ruangan' => 'nullable|string|max:100',
            'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'durasi' => 'required|integer',
            'kapasitas' => 'required|integer',
            'trainer_id' => 'required|exists:trainers,trainer_id',
        ]);

        $data = $request->only(['nama_kelas','deskripsi','ruangan','hari','waktu_mulai','waktu_selesai','durasi','kapasitas','trainer_id']);

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('class-covers', 'public');
            $data['cover'] = $coverPath;
        }

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

        // gatau kata gpt kek gini co buat maksa load enrolled viewMembers
        $members = $gymClass->bookings()
            ->with(['member.user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gym_class.show', [
            'class' => $gymClass,
            'members' => $members,
        ]);
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
            'ruangan' => 'nullable|string|max:100',
            'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'durasi' => 'required|integer',
            'kapasitas' => 'required|integer',
            'trainer_id' => 'required|exists:trainers,trainer_id',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['nama_kelas','deskripsi','ruangan','hari','waktu_mulai','waktu_selesai','durasi','kapasitas','trainer_id']);

        if ($request->hasFile('cover')) {
            if ($gymClass->cover && \Storage::disk('public')->exists($gymClass->cover)) {
                \Storage::disk('public')->delete($gymClass->cover);
            }
            $coverPath = $request->file('cover')->store('class-covers', 'public');
            $data['cover'] = $coverPath;
        }

        $gymClass->update($data);

        if ($request->hasFile('cover')) {
            if ($gymClass->cover && \Storage::disk('public')->exists($gymClass->cover)) {
                \Storage::disk('public')->delete($gymClass->cover);
            }
            $coverPath = $request->file('cover')->store('class-covers', 'public');
            $data['cover'] = $coverPath;
        }

        $gymClass->update($data);

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
