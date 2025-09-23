<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trainer;
use App\Models\User;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $availableUsers = User::whereDoesntHave('member')->get();

        foreach ($availableUsers->take(3) as $user) {
            Trainer::create([
                'user_id' => $user->user_id,
                'spesialisasi' => fake()->word(),
            ]);
        }
    }
}
