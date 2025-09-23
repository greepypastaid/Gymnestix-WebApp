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
        $this->call(UserSeeder::class);
        $this->call(MemberSeeder::class);
        $this->call(TrainerSeeder::class);
        $this->call(ClassSeeder::class);
        $this->call(MembershipPlansSeeder::class);
    }

}
