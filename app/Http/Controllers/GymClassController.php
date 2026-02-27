<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\GymClass;
use App\Models\Trainer;

class GymClassController extends Controller
{
    /**
     * Display the members of a specific class
     */
    public function viewMembers(GymClass $gymClass)
    {
        $this->authorizeOwnership($gymClass, request());

        $members = $gymClass->bookings()
            ->with(['member.user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('trainer.class.members', [
            'class' => $gymClass,
            'members' => $members
        ]);
    }

    /**
     * Display a listing of the resource for trainer.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $trainer = $user->trainer;
        if (!$trainer) {
            abort(403, 'Anda bukan trainer.');
        }

        $query = GymClass::with('trainer.user')
            ->withCount('bookings')
            ->where('trainer_id', $trainer->trainer_id);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_kelas', 'LIKE', "%{$search}%")
                  ->orWhere('hari', 'LIKE', "%{$search}%")
                  ->orWhere('ruangan', 'LIKE', "%{$search}%");
            });
        }

        $classes = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('trainer.class.trainerClass', compact('classes'));
    }

    /**
     * Show the form for creating a new resource for trainer.
     */
    public function create(Request $request)
    {
        $user = $request->user();
        if (!$user->isTrainer()) { abort(403, 'Anda bukan trainer.'); }

        return view('trainer.class.createTrainerClass');
    }

    /**
     * Store a newly created resource in storage for trainer.
     */
    public function store(Request $request)
    {
        // Write what we actually received
        file_put_contents(storage_path('request_dump.txt'), 'ALL REQUEST DATA:' . PHP_EOL . json_encode($request->all(), JSON_PRETTY_PRINT) . PHP_EOL . PHP_EOL);
        
        $user = $request->user();

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ruangan' => 'nullable|string|max:100',
            'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'durasi' => 'required|integer',
            'kapasitas' => 'required|integer',
        ]);

        // Set trainer_id to current trainer
        $trainer = $user->trainer;
        if (!$trainer) {
            abort(403, 'Anda bukan trainer.');
        }

        $data = $request->only(['nama_kelas','deskripsi','ruangan','waktu_mulai','waktu_selesai','durasi','kapasitas']);
        $data['hari'] = $request->input('hari');
        $data['trainer_id'] = $trainer->trainer_id;

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('class-covers', 'public');
            $data['cover'] = $coverPath;
        }

        // Prevent overlapping schedule for same trainer on same day
        // Overlap condition: new.start < existing.end AND existing.start < new.end
        $start = $data['waktu_mulai'];
        $end = $data['waktu_selesai'];

        $overlap = GymClass::where('trainer_id', $trainer->trainer_id)
            ->where('hari', $data['hari'])
            ->where(function($q) use ($start, $end) {
                $q->where(function($q2) use ($start, $end) {
                    $q2->where('waktu_mulai', '<', $end)
                        ->where('waktu_selesai', '>', $start);
                });
            })->exists();

        if ($overlap) {
            return back()->withErrors(['hari' => 'Anda sudah memiliki jadwal yang tumpang tindih pada hari dan jam tersebut.'])->withInput();
        }

        // Temporary debug logging
        Log::debug('GymClass store - DATA ABOUT TO CREATE', [
            'request_hari' => $request->input('hari'),
            'data_hari' => $data['hari'] ?? 'NOT SET',
            'full_data' => $data,
        ]);

        
        $created = GymClass::create($data);

        Log::debug('GymClass created - VERIFICATION', [
            'class_id' => $created->class_id,
            'hari_from_db' => $created->hari,
            'all_attrs' => $created->toArray(),
        ]);

        return redirect()->route('trainer.classes.index')->with('success','Kelas dibuat.');
    }

    /**
     * Ensure the current user can manage/view this class (trainer only).
     * aborts with 403 if unauthorized.
     */
    protected function authorizeOwnership(GymClass $gymClass, Request $request)
    {
        $user = $request->user();

        $trainer = $user->trainer;
        if (!$trainer || $gymClass->trainer_id !== $trainer->trainer_id) {
            abort(403, 'You do not own this class.');
        }
    }

    /**
     * Show the form for editing the specified resource for trainer.
     */
    public function edit(GymClass $gymClass, Request $request)
    {
        $this->authorizeOwnership($gymClass, $request);

        // changed view path:
        return view('trainer.class.editTrainerClass', compact('gymClass'));
    }

    /**
     * Update the specified resource in storage for trainer.
     */
    public function update(Request $request, GymClass $gymClass)
    {
        $this->authorizeOwnership($gymClass, $request);

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ruangan' => 'nullable|string|max:100',
            'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'durasi' => 'required|integer',
            'kapasitas' => 'required|integer',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['nama_kelas','deskripsi','ruangan','hari','waktu_mulai','waktu_selesai','durasi','kapasitas']);

        if ($request->hasFile('cover')) {
            if ($gymClass->cover && \Storage::disk('public')->exists($gymClass->cover)) {
                \Storage::disk('public')->delete($gymClass->cover);
            }
            $coverPath = $request->file('cover')->store('class-covers', 'public');
            $data['cover'] = $coverPath;
        }

        $trainer = $request->user()->trainer;
        if ($trainer) {
            $start = $data['waktu_mulai'];
            $end = $data['waktu_selesai'];

            $conflict = GymClass::where('trainer_id', $trainer->trainer_id)
                ->where('hari', $data['hari'])
                ->where('class_id', '<>', $gymClass->class_id)
                ->where(function($q) use ($start, $end) {
                    $q->where('waktu_mulai', '<', $end)
                      ->where('waktu_selesai', '>', $start);
                })
                ->exists();

            if ($conflict) {
                return back()->withErrors(['hari' => 'Anda sudah memiliki jadwal yang tumpang tindih pada hari dan jam tersebut.'])->withInput();
            }
        }

        $gymClass->update($data);

        return redirect()->route('trainer.classes.index')->with('success','Kelas diperbarui.');
    }

    /**
     * Remove the specified resource from storage for trainer.
     */
    public function destroy(GymClass $gymClass, Request $request)
    {
        $this->authorizeOwnership($gymClass, $request);
        $gymClass->delete();

        return redirect()->route('trainer.classes.index')->with('success','Kelas dihapus.');
    }

    /**
     * Display the specified resource for trainer.
     */
    public function show(GymClass $gymClass)
    {
        // Ensure user can view this class (must be owner trainer)
        $this->authorizeOwnership($gymClass, request());

        // Show trainer-specific detail view
        return view('pages.dashboard.trainer.class.show', compact('gymClass'));
    }
}
