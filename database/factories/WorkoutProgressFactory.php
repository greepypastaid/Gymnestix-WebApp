<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkoutProgress>
 */
class WorkoutProgressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $exerciseTypes = [
            'Push-ups', 'Pull-ups', 'Squats', 'Deadlifts', 'Bench Press',
            'Overhead Press', 'Barbell Rows', 'Bicep Curls', 'Tricep Dips',
            'Lunges', 'Planks', 'Burpees', 'Mountain Climbers', 'Jumping Jacks',
            'Dumbbell Shoulder Press', 'Lat Pulldowns', 'Leg Press', 'Calf Raises'
        ];

        $exerciseType = $this->faker->randomElement($exerciseTypes);

        // Different rep ranges for different exercise types
        $repRanges = [
            'Push-ups' => [10, 50],
            'Pull-ups' => [3, 15],
            'Squats' => [5, 20],
            'Deadlifts' => [3, 10],
            'Bench Press' => [5, 15],
            'Overhead Press' => [5, 12],
            'Barbell Rows' => [6, 15],
            'Bicep Curls' => [8, 20],
            'Tricep Dips' => [8, 20],
            'Lunges' => [8, 16],
            'Planks' => [1, 5], // minutes
            'Burpees' => [5, 20],
            'Mountain Climbers' => [20, 60], // seconds
            'Jumping Jacks' => [20, 100],
            'Dumbbell Shoulder Press' => [8, 15],
            'Lat Pulldowns' => [8, 15],
            'Leg Press' => [8, 15],
            'Calf Raises' => [12, 25]
        ];

        $repRange = $repRanges[$exerciseType] ?? [8, 15];
        $reps = $this->faker->numberBetween($repRange[0], $repRange[1]);

        // Duration in minutes (some exercises are time-based)
        $timeBasedExercises = ['Planks', 'Mountain Climbers'];
        $duration = in_array($exerciseType, $timeBasedExercises)
            ? $this->faker->numberBetween(1, 5)
            : $this->faker->numberBetween(5, 30);

        // Weight ranges for different exercises
        $weightRanges = [
            'Push-ups' => [0, 0], // bodyweight
            'Pull-ups' => [0, 0], // bodyweight
            'Squats' => [40, 150],
            'Deadlifts' => [60, 200],
            'Bench Press' => [40, 150],
            'Overhead Press' => [20, 80],
            'Barbell Rows' => [40, 100],
            'Bicep Curls' => [10, 30],
            'Tricep Dips' => [0, 0], // bodyweight
            'Lunges' => [10, 40], // dumbbells
            'Planks' => [0, 0], // bodyweight
            'Burpees' => [0, 0], // bodyweight
            'Mountain Climbers' => [0, 0], // bodyweight
            'Jumping Jacks' => [0, 0], // bodyweight
            'Dumbbell Shoulder Press' => [8, 25],
            'Lat Pulldowns' => [30, 80],
            'Leg Press' => [50, 150],
            'Calf Raises' => [20, 60]
        ];

        $weightRange = $weightRanges[$exerciseType] ?? [10, 50];
        $weight = $weightRange[0] === 0 && $weightRange[1] === 0
            ? 0
            : $this->faker->randomFloat(1, $weightRange[0], $weightRange[1]);

        return [
            'member_id' => Member::factory(),
            'tanggal' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'jenis_latihan' => $exerciseType,
            'catatan_repetisi' => $reps,
            'catatan_durasi' => $duration,
            'catatan_berat' => $weight,
        ];
    }
}
