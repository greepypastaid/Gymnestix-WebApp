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
        // First, create trainers for users with trainer role
        $trainerUsers = User::whereHas('role', function($query) {
            $query->where('name', 'trainer');
        })->get();

        foreach ($trainerUsers as $user) {
            Trainer::firstOrCreate(
                ['user_id' => $user->user_id],
                ['spesialisasi' => fake()->word()]
            );
        }

        // Then create additional trainers for other users if needed
        $availableUsers = User::whereDoesntHave('member')
            ->whereDoesntHave('trainer')
            ->take(3)
            ->get();

        foreach ($availableUsers as $user) {
            Trainer::create([
                'user_id' => $user->user_id,
                'spesialisasi' => fake()->word(),
            ]);
        }
    }
}
