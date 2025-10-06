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
