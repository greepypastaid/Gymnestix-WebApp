<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MembershipPlanController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\GymClassController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ScheduleAssignmentController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\EquipmentsController;
use App\Http\Controllers\WorkoutProgressController;

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

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Schedule + Assign Trainer (CRUD)
    Route::get('/schedules', [ScheduleAssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/schedules/create', [ScheduleAssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/schedules', [ScheduleAssignmentController::class, 'store'])->name('assignments.store');
    Route::get('/schedules/{schedule}/edit', [ScheduleAssignmentController::class, 'edit'])->name('assignments.edit');
    Route::put('/schedules/{schedule}', [ScheduleAssignmentController::class, 'update'])->name('assignments.update');
    Route::delete('/schedules/{schedule}', [ScheduleAssignmentController::class, 'destroy'])->name('assignments.destroy');

// Attendance (track)
    Route::middleware('can:attendance.track')->group(function () {
        Route::get('/attendance', [\App\Http\Controllers\Admin\AttendanceController::class, 'index'])->name('attendance.index');
        Route::get('/attendance/create', [\App\Http\Controllers\Admin\AttendanceController::class, 'create'])->name('attendance.create');
        Route::post('/attendance', [\App\Http\Controllers\Admin\AttendanceController::class, 'store'])->name('attendance.store');
        Route::get('/attendance/{attendance}/edit', [\App\Http\Controllers\Admin\AttendanceController::class, 'edit'])->name('attendance.edit');
        Route::put('/attendance/{attendance}', [\App\Http\Controllers\Admin\AttendanceController::class, 'update'])->name('attendance.update');
        Route::delete('/attendance/{attendance}', [\App\Http\Controllers\Admin\AttendanceController::class, 'destroy'])->name('attendance.destroy');
    });

    // Equipment (resource routes -> will create named routes like admin.equipment.index)
    Route::resource('equipment', EquipmentsController::class)
        ->only(['index','create','store','show','edit','update','destroy'])
        ->middleware([
            'index'   => 'can:equipment.view_all',
            'show'    => 'can:equipment.view_all',
            'create'  => 'can:equipment.manage',
            'store'   => 'can:equipment.manage',
            'edit'    => 'can:equipment.manage',
            'update'  => 'can:equipment.manage',
            'destroy' => 'can:equipment.manage',
        ]);

    // Workout manager (resource routes -> creates admin.workout.index etc.)
    Route::resource('workout', WorkoutProgressController::class)
        ->only(['index','create','store','show','edit','update','destroy'])
        ->middleware([
            'index'   => 'can:workout.manage',
            'show'    => 'can:workout.manage',
            'create'  => 'can:workout.manage',
            'store'   => 'can:workout.manage',
            'edit'    => 'can:workout.manage',
            'update'  => 'can:workout.manage',
            'destroy' => 'can:workout.manage',
        ]);
});
    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('permissions', PermissionController::class)->middleware(['auth', 'verified']);
    Route::get('/roles-permissions', [RolePermissionController::class, 'index'])->name('roles.permissions');

    // CRUD Admin User/Member
    Route::resource('admin', AdminController::class)
        ->parameters(['admin' => 'user'])
        ->middleware(['auth', 'verified']);

    // CRUD Membership Plan
    Route::resource('membership_plan', MembershipPlanController::class)
        ->middleware(['auth', 'verified']);

    // CRUD Billing (Pembayaran)
    Route::resource('billing', BillingController::class)->middleware(['auth', 'verified']);

    // CRUD Jadwal Kelas/Gym (Schedule)
    Route::resource('gym_class', GymClassController::class)->middleware(['auth', 'verified']);

});

require __DIR__ . '/auth.php';
