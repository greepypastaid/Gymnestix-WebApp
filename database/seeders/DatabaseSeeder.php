<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(
            [
                RoleSeeder::class,
                PermissionSeeder::class,
                RolePermissionSeeder::class,
                UserSeeder::class,
                MemberSeeder::class,
                TrainerSeeder::class,
                ClassSeeder::class,
                MembershipPlansSeeder::class,
                WorkoutProgressSeeder::class,
                MemberClassEnrollmentSeeder::class,
                EquipmentsSeeder::class
            ]
        );
    }
}
