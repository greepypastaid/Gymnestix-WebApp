<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\WorkoutProgress;
use Illuminate\Database\Seeder;

class WorkoutProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all existing members
        $members = Member::all();

        if ($members->isEmpty()) {
            $this->command->info('No members found. Skipping workout progress seeding.');
            return;
        }

        // Create multiple workout sessions for each member
        foreach ($members as $member) {
            // Create 5-15 workout sessions per member
            $workoutCount = rand(5, 15);

            for ($i = 0; $i < $workoutCount; $i++) {
                WorkoutProgress::factory()->create([
                    'member_id' => $member->member_id,
                ]);
            }
        }
    }
}