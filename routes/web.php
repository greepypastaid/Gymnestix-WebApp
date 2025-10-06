<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ScheduleAssignmentController;
use App\Http\Controllers\Admin\AttendanceController;

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
});
    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
