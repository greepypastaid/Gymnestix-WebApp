<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'System Administrator',
                'description' => 'Full system access and management capabilities',
                'is_active' => true
            ],
            [
                'name' => 'trainer',
                'display_name' => 'Trainer',
                'description' => 'Trainer role',
                'is_active' => true
            ],
            [
                'name' => 'member',
                'display_name' => 'Member',
                'description' => 'Member role',
                'is_active' => true
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
