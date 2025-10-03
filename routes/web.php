<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GymClassController;
use App\Http\Controllers\EquipmentsController;
use App\Http\Controllers\WorkoutProgressController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Main dashboard - redirects based on role
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Role-specific dashboards
Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');

Route::get('/trainer/dashboard', [DashboardController::class, 'trainer'])
    ->middleware(['auth', 'verified'])
    ->name('trainer.dashboard');

Route::get('/member/dashboard', [DashboardController::class, 'member'])
    ->middleware(['auth', 'verified'])
    ->name('member.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Buat Trainer Le
Route::prefix('trainer')->name('trainer.')->middleware(['auth','verified'])->group(function () {
    // Classes
    Route::get('/classes', [GymClassController::class,'index'])->name('classes.index')->middleware('permission:schedule.view_all');
    Route::get('/classes/create', [GymClassController::class,'create'])->name('classes.create')->middleware('permission:schedule.create_limited');
    Route::post('/classes', [GymClassController::class,'store'])->name('classes.store')->middleware('permission:schedule.create_limited');
    Route::get('/classes/{gymClass}/edit', [GymClassController::class,'edit'])->name('classes.edit')->middleware('permission:schedule.create_limited');
    Route::put('/classes/{gymClass}', [GymClassController::class,'update'])->name('classes.update')->middleware('permission:schedule.create_limited');
    Route::delete('/classes/{gymClass}', [GymClassController::class,'destroy'])->name('classes.destroy')->middleware('permission:schedule.create_limited');
    Route::get('/classes/{gymClass}/members', [GymClassController::class,'viewMembers'])->name('classes.members')->middleware('auth');

    // Equipments (Trainer view only)
    Route::get('/equipments', [EquipmentsController::class,'index'])->name('equipments.index')->middleware('permission:equipment.view_all');
    Route::patch('/equipments/{equipments}/report', [EquipmentsController::class,'reportIssue'])->name('equipments.report')->middleware('permission:equipment.view_all');

    // View member workouts
    Route::get('/members/{member}/workouts', [WorkoutProgressController::class,'indexForMember'])
        ->name('members.workouts.index')
        ->middleware('permission:workout.view_member');

    // Attendance (Trainer)
    Route::get('/attendance/select-class', [\App\Http\Controllers\AttendanceController::class, 'selectClass'])
        ->name('attendance.select-class')
        ->middleware('permission:attendance.track');
    Route::get('/attendance/{class}/track', [\App\Http\Controllers\AttendanceController::class, 'track'])
        ->name('attendance.track')
        ->middleware('permission:attendance.track');
    Route::post('/attendance/{class}', [\App\Http\Controllers\AttendanceController::class, 'store'])
        ->name('attendance.store')
        ->middleware('permission:attendance.track');
    Route::get('/attendance/view-all', [\App\Http\Controllers\AttendanceController::class, 'viewAll'])
        ->name('attendance.view_all')
        ->middleware('permission:attendance.view_all');
});

// Admin routes (for future admin dashboard)
Route::prefix('admin')->name('admin.')->middleware(['auth','verified'])->group(function () {
    // Equipment management (full CRUD for admin)
    Route::get('/equipments', [EquipmentsController::class,'index'])->name('equipments.index')->middleware('permission:equipment.manage');
    Route::get('/equipments/create', [EquipmentsController::class,'create'])->name('equipments.create')->middleware('permission:equipment.manage');
    Route::post('/equipments', [EquipmentsController::class,'store'])->name('equipments.store')->middleware('permission:equipment.manage');
    Route::get('/equipments/{equipments}', [EquipmentsController::class,'show'])->name('equipments.show')->middleware('permission:equipment.manage');
    Route::get('/equipments/{equipments}/edit', [EquipmentsController::class,'edit'])->name('equipments.edit')->middleware('permission:equipment.manage');
    Route::put('/equipments/{equipments}', [EquipmentsController::class,'update'])->name('equipments.update')->middleware('permission:equipment.manage');
    Route::delete('/equipments/{equipments}', [EquipmentsController::class,'destroy'])->name('equipments.destroy')->middleware('permission:equipment.manage');
});

require __DIR__ . '/auth.php';
