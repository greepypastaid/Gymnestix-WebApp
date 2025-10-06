<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\GymClass;
use App\Models\Trainer;

class GymClassController extends Controller
{
    /**
     * Display the members of a specific class
     */
    public function viewMembers(GymClass $gymClass)
    {
        $user = request()->user();

        // authorize: admin/permission or owner trainer
        $this->authorizeOwnership($gymClass, request());

        $members = $gymClass->bookings()
            ->with(['member.user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.dashboard.trainer.class.members', [
            'class' => $gymClass,
            'members' => $members
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // If user can view all schedules (admin/manager), show all classes
        if (Gate::allows('schedule.view_all') || $user->hasPermission('schedule.view_all') ?? false) {
            $classes = GymClass::with(['trainer.user'])->paginate(15);
            return view('gym_class.index', compact('classes'));
        }

        // Otherwise require trainer and show only classes owned by trainer
        $trainer = $user->trainer;
        if (!$trainer) {
            abort(403, 'Anda bukan trainer.');
        }

        $classes = GymClass::with('trainer.user')
            ->where('trainer_id', $trainer->trainer_id)
            ->paginate(15);

        return view('pages.dashboard.trainer.class.trainerClass', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = $request->user();

        // Trainers create for themselves
        if (!Gate::allows('schedule.assign_trainer') && !$user->isTrainer()) {
            abort(403);
        }

        // Use trainer-specific create view
        return view('pages.dashboard.trainer.class.createTrainerClass');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'durasi' => 'required|integer',
            'kapasitas' => 'required|integer',
        ]);

        // Determine trainer_id: if admin and provided, allow; otherwise set to current trainer
        if (Gate::allows('schedule.assign_trainer') && $request->filled('trainer_id')) {
            $trainerId = $request->input('trainer_id');
        } else {
            $trainer = $user->trainer;
            if (!$trainer) {
                abort(403, 'Anda bukan trainer.');
            }
            $trainerId = $trainer->trainer_id;
        }

        $data = $request->only(['nama_kelas','deskripsi','waktu_mulai','waktu_selesai','durasi','kapasitas']);
        $data['trainer_id'] = $trainerId;

        GymClass::create($data);

        // redirect depending on role
        if (Gate::allows('schedule.view_all')) {
            return redirect()->route('gym_class.index')->with('success', 'Jadwal kelas berhasil ditambahkan!');
        }

        return redirect()->route('trainer.classes.index')->with('success','Kelas dibuat.');
    }

    /**
     * Ensure the current user can manage/view this class.
     * aborts with 403 if unauthorized.
     */
    protected function authorizeOwnership(GymClass $gymClass, Request $request)
    {
        $user = $request->user();

        // admins or users with schedule.view_all can access
        if (Gate::allows('schedule.view_all') || ($user->hasPermission('schedule.view_all') ?? false)) {
            return;
        }

        $trainer = $user->trainer;
        if (!$trainer || $gymClass->trainer_id !== $trainer->trainer_id) {
            abort(403, 'You do not own this class.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GymClass $gymClass, Request $request)
    {
        $this->authorizeOwnership($gymClass, $request);

        // Jika user punya akses melihat semua jadwal (admin / manager),
        // gunakan view admin (resource-based) yang menunjuk ke route gym_class.update
        if (Gate::allows('schedule.view_all')) {
            // Ambil daftar trainers untuk select input (sesuaikan fields jika berbeda)
            $trainers = Trainer::with('user')->get();
            return view('gym_class.edit', compact('gymClass', 'trainers'));
        }

        // Default: trainer-specific edit view (route names untuk trainer)
        return view('pages.dashboard.trainer.class.editTrainerClass', compact('gymClass'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GymClass $gymClass)
    {
        $this->authorizeOwnership($gymClass, $request);

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'durasi' => 'required|integer',
            'kapasitas' => 'required|integer',
        ]);

        $gymClass->update($request->only(['nama_kelas','deskripsi','waktu_mulai','waktu_selesai','durasi','kapasitas']));

        if (Gate::allows('schedule.view_all')) {
            return redirect()->route('gym_class.index')->with('success', 'Kelas diperbarui.');
        }

        return redirect()->route('trainer.classes.index')->with('success','Kelas diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymClass $gymClass, Request $request)
    {
        $this->authorizeOwnership($gymClass, $request);
        $gymClass->delete();

        if (Gate::allows('schedule.view_all')) {
            return redirect()->route('gym_class.index')->with('success', 'Kelas dihapus.');
        }

        return redirect()->route('trainer.classes.index')->with('success','Kelas dihapus.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GymClass $gymClass)
    {
        // pastikan user boleh melihat kelas ini (admin / owner trainer)
        $this->authorizeOwnership($gymClass, request());

        // tampilkan view detail kelas (resources/views/gym_class/show.blade.php)
        return view('gym_class.show', compact('gymClass'));
    }
}
