<?php

use App\Models\MembershipPlan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\GymClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Member\ClassController;
use App\Http\Controllers\MembershipPlanController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\WorkoutProgressController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\EquipmentsController;
use App\Http\Controllers\MembershipPaymentController;
use App\Http\Controllers\Admin\ScheduleAssignmentController;

Route::get('/', function () {
    $membershipPlans = MembershipPlan::all();
    return view('welcome', compact('membershipPlans'));
})->name('home');

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
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->middleware([
            'index'   => 'permission:equipment.manage',
            'show'    => 'permission:equipment.manage',
            'create'  => 'permission:equipment.manage',
            'store'   => 'permission:equipment.manage',
            'edit'    => 'permission:equipment.manage',
            'update'  => 'permission:equipment.manage',
            'destroy' => 'permission:equipment.manage',
        ]);

    // Workout manager (resource routes -> creates admin.workouts.index etc.)
    Route::resource('workouts', \App\Http\Controllers\Admin\WorkoutController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
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

    // CRUD Jadwal Kelas/Gym (Schedule) - Admin uses Admin controller
    Route::resource('gym_class', \App\Http\Controllers\Admin\GymClassController::class)->middleware(['auth', 'verified']);
});

// Buat Trainer Le
Route::prefix('trainer')->name('trainer.')->middleware(['auth', 'verified'])->group(function () {
    // Classes
    Route::get('/classes', [GymClassController::class, 'index'])->name('classes.index');
    Route::get('/classes/create', [GymClassController::class, 'create'])->name('classes.create')->middleware('permission:schedule.create_limited');
    Route::post('/classes', [GymClassController::class, 'store'])->name('classes.store')->middleware('permission:schedule.create_limited');
    Route::get('/classes/{gymClass}/edit', [GymClassController::class, 'edit'])->name('classes.edit')->middleware('permission:schedule.create_limited');
    Route::put('/classes/{gymClass}', [GymClassController::class, 'update'])->name('classes.update')->middleware('permission:schedule.create_limited');
    Route::delete('/classes/{gymClass}', [GymClassController::class, 'destroy'])->name('classes.destroy')->middleware('permission:schedule.create_limited');
    Route::get('/classes/{gymClass}/members', [GymClassController::class, 'viewMembers'])->name('classes.members')->middleware('auth');

    // Equipments (Trainer view only)
    Route::get('/equipments', [\App\Http\Controllers\EquipmentsController::class, 'index'])->name('equipments.index')->middleware('permission:equipment.view_all');
    Route::patch('/equipments/{equipments}/report', [\App\Http\Controllers\EquipmentsController::class, 'reportIssue'])->name('equipments.report')->middleware('permission:equipment.view_all');

    // View member workouts
    Route::get('/members/{member}/workouts', [WorkoutProgressController::class, 'indexForMember'])
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
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    // Equipment management (full CRUD for admin)
    Route::get('/equipments', [\App\Http\Controllers\Admin\EquipmentsController::class, 'index'])->name('equipments.index')->middleware('permission:equipment.manage');
    Route::get('/equipments/create', [\App\Http\Controllers\Admin\EquipmentsController::class, 'create'])->name('equipments.create')->middleware('permission:equipment.manage');
    Route::post('/equipments', [\App\Http\Controllers\Admin\EquipmentsController::class, 'store'])->name('equipments.store')->middleware('permission:equipment.manage');
    Route::get('/equipments/{equipments}', [\App\Http\Controllers\Admin\EquipmentsController::class, 'show'])->name('equipments.show')->middleware('permission:equipment.manage');
    Route::get('/equipments/{equipments}/edit', [\App\Http\Controllers\Admin\EquipmentsController::class, 'edit'])->name('equipments.edit')->middleware('permission:equipment.manage');
    Route::put('/equipments/{equipments}', [\App\Http\Controllers\Admin\EquipmentsController::class, 'update'])->name('equipments.update')->middleware('permission:equipment.manage');
    Route::delete('/equipments/{equipments}', [\App\Http\Controllers\Admin\EquipmentsController::class, 'destroy'])->name('equipments.destroy')->middleware('permission:equipment.manage');
});

Route::middleware(['auth'])->prefix('member')->name('member.')->group(function () {
    Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
    Route::post('/classes/join/{class}', [ClassController::class, 'join'])->name('classes.join');
});

Route::get('/kelas', [ClassController::class, 'index'])->name('classes.index');

// Trainers public page
Route::get('/trainers', [TrainerController::class, 'index'])->name('trainers.index');

// Features public page
Route::get('/features', function () {
    return view('landing_page.pages.features');
})->name('features');

// Pricing public page
Route::get('/pricing', function () {
    $membershipPlans = MembershipPlan::all();
    return view('landing_page.pages.pricing', compact('membershipPlans'));
})->name('pricing');

// checkout
Route::middleware('auth')->group(function () {
    Route::get('/membership/checkout/{plan_id}', [MembershipPaymentController::class, 'checkout'])
        ->name('membership.checkout');
});

Route::post('/webhook/payment', [WebhookController::class, 'handlePayment'])->name('webhook.payment');


require __DIR__ . '/auth.php';
