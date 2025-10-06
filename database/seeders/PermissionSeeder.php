<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'users.manage', 'display_name' => 'Manage Users', 'group' => 'users'],
            ['name' => 'users.list', 'display_name' => 'List Users', 'group' => 'users'],
            ['name' => 'users.view', 'display_name' => 'View User Detail', 'group' => 'users'],

            ['name' => 'plans.manage', 'display_name' => 'Manage Membership Plans', 'group' => 'membership'],


            ['name' => 'payments.manage', 'display_name' => 'Manage Payments', 'group' => 'payments'],
            ['name' => 'payments.create_own', 'display_name' => 'Create Own Payment', 'group' => 'payments'],
            ['name' => 'payments.view_history_own', 'display_name' => 'View Own Payment History', 'group' => 'payments'],

            ['name' => 'schedule.manage', 'display_name' => 'Manage Schedule', 'group' => 'schedule'],
            ['name' => 'schedule.assign_trainer', 'display_name' => 'Assign Trainer to Schedule', 'group' => 'schedule'],
            ['name' => 'schedule.view_all', 'display_name' => 'View All Schedules', 'group' => 'schedule'],
            ['name' => 'schedule.create_limited', 'display_name' => 'Create Limited Schedule', 'group' => 'schedule'],

            ['name' => 'attendance.track', 'display_name' => 'Track Attendance', 'group' => 'attendance'],
            ['name' => 'attendance.view_all', 'display_name' => 'View All Attendance', 'group' => 'attendance'],
            ['name' => 'attendance.view_own', 'display_name' => 'View Own Attendance', 'group' => 'attendance'],

            ['name' => 'profile.update_own', 'display_name' => 'Update Own Profile', 'group' => 'profile'],

            ['name' => 'bookings.create_own', 'display_name' => 'Create Own Booking', 'group' => 'bookings'],
            ['name' => 'bookings.cancel_own', 'display_name' => 'Cancel Own Booking', 'group' => 'bookings'],

            ['name' => 'equipment.manage', 'display_name' => 'Manage Equipment', 'group' => 'equipment'],
            ['name' => 'equipment.view_all', 'display_name' => 'View All Equipment', 'group' => 'equipment'],

            ['name' => 'workout.manage', 'display_name' => 'Manage Workouts', 'group' => 'workout'],
            ['name' => 'workout.view_member', 'display_name' => 'View Member Workout', 'group' => 'workout'],
            ['name' => 'workout.view_own', 'display_name' => 'View Own Workout', 'group' => 'workout'],
            ['name' => 'workout.track_own', 'display_name' => 'Track Own Workout', 'group' => 'workout'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                $permission
            );
        }
    }
}
