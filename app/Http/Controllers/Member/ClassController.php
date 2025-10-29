<?php

namespace App\Http\Controllers\Member;

use App\Models\Member;
use App\Models\ClassModel;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    // 🧾 Menampilkan semua kelas
    public function index()
    {
        $classes = ClassModel::paginate(6);
        $userClasses = [];
        if (Auth::check() && Auth::user()->role->name === 'member') {
            $member = Auth::user()->member;
            if ($member) {
                // ambil ID kelas yang sudah diikuti oleh member
                $userClasses = $member->classes()->select('classes.class_id', 'class_user.expired_at')->get();
            }
        }
        return view('landing_page.pages.classes', compact('classes', 'userClasses'));
    }



    // 🟢 Bergabung ke kelas tertentu
    public function join($classId)
    {
        $user = Auth::user();

        // Pastikan user punya member record
        $member = Member::where('user_id', $user->user_id)->first();
        if (!$member) {
            return back()->with('error', 'Anda belum menjadi member.');
        }

        // Pastikan membership masih aktif
        if ($member->expired_at && $member->expired_at < Carbon::now()) {
            return back()->with('error', 'Membership Anda sudah expired!');
        }

        $class = ClassModel::findOrFail($classId);

        // Cek apakah kelas sudah penuh
        $joinedCount = $class->members()->count();
        if ($joinedCount >= $class->kapasitas) {
            return back()->with('error', 'Kelas sudah penuh!');
        }

        // Cek apakah sudah pernah join sebelumnya
        if ($class->members()->where('member_id', $member->member_id)->exists()) {
            return back()->with('error', 'Anda sudah terdaftar di kelas ini.');
        }

        // Attach ke pivot
        $class->members()->attach($member->member_id, [
            'joined_at' => now(),
            'expired_at' => $member->expired_at,
            'status'    => 'active',
        ]);

        return back()->with('success', 'Berhasil join kelas!');
    }
}
