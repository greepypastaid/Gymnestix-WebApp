<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
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

// Route buat trainer 
Route::middleware(['auth', 'permission:schedule.view_all'])->prefix('trainer')->name('trainer.')->group(function () {
    // Schedule (GymClass) - view all
    Route::get('/classes', [App\Http\Controllers\GymClassController::class, 'index'])->name('classes.index');

    // Create limited (only trainer can create own class)
    Route::get('/classes/create', [App\Http\Controllers\GymClassController::class, 'create'])
        ->middleware('permission:schedule.create_limited')->name('classes.create');
    Route::post('/classes', [App\Http\Controllers\GymClassController::class, 'store'])
        ->middleware('permission:schedule.create_limited')->name('classes.store');

    // Edit / delete (only if trainer owns the class)
    Route::get('/classes/{gymClass}/edit', [App\Http\Controllers\GymClassController::class, 'edit'])
        ->name('classes.edit');
    Route::put('/classes/{gymClass}', [App\Http\Controllers\GymClassController::class, 'update'])
        ->name('classes.update');
    Route::delete('/classes/{gymClass}', [App\Http\Controllers\GymClassController::class, 'destroy'])
        ->name('classes.destroy');

    // View member workout (trainer permission)
    Route::get('/members/{member}/workouts', [App\Http\Controllers\WorkoutProgressController::class, 'indexForMember'])
        ->middleware('permission:workout.view_member')
        ->name('members.workouts');

    // Equipment (view all)
    Route::get('/equipments', [App\Http\Controllers\EquipmentsController::class, 'index'])
        ->middleware('permission:equipment.view_all')->name('equipments.index');
});

require __DIR__ . '/auth.php';
