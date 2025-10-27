<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    // 🧾 Menampilkan semua kelas
    public function index()
    {
        $classes = ClassModel::all();
        $userClasses = Auth::user() ? Auth::user()->classes : null;

        return view('landing_page.pages.classes', compact('classes', 'userClasses'));
    }

    // 🟢 Bergabung ke kelas tertentu
    public function join($classId)
    {
        $user = Auth::user();

        // Cegah user daftar dua kali ke kelas yang sama
        if ($user->classes()->where('class_id', $classId)->exists()) {
            return redirect()->route('member.classes.index')->with('error', 'Kamu sudah terdaftar di kelas ini.');
        }

        $user->classes()->attach($classId, [
            'joined_at' => now(),
            'expired_at' => now()->addMonths(1),
            'status' => 'active',
        ]);

        return redirect()->route('member.classes.index')->with('success', 'Berhasil bergabung ke kelas!');
    }
}
