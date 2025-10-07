<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // ===== Admin =====
        $adminRole = Role::where('name', 'admin')->first();
        $adminPermissions = Permission::whereIn('name', [
            'users.manage',
            'plans.manage',
            'payments.manage',
            'schedule.manage',
            'schedule.assign_trainer',
            'attendance.view_all',
            'attendance.track',
            'attendance.view_own',
            'equipment.manage',
            'equipment.view_all',
            'workout.manage',
        ])->get();
    $adminRole->permissions()->syncWithoutDetaching($adminPermissions->pluck('id')->toArray());

        // ===== Trainer =====
        $trainerRole = Role::where('name', 'trainer')->first();
        $trainerPermissions = Permission::whereIn('name', [
            'users.list',
            'users.view',
            'schedule.view_all',
            'attendance.track',
            'attendance.view_all',
            'schedule.create_limited',
            'workout.view_member',
            'equipment.view_all',
        ])->get();
    $trainerRole->permissions()->syncWithoutDetaching($trainerPermissions->pluck('id')->toArray());

        // ===== Member =====
        $memberRole = Role::where('name', 'member')->first();
        $memberPermissions = Permission::whereIn('name', [
            'profile.update_own',
            'schedule.view_all',
            'bookings.create_own',
            'bookings.cancel_own',
            'payments.create_own',
            'payments.view_history_own',
            'workout.view_own',
            'workout.track_own',
            'attendance.view_own',
        ])->get();
    $memberRole->permissions()->syncWithoutDetaching($memberPermissions->pluck('id')->toArray());
    }
}
