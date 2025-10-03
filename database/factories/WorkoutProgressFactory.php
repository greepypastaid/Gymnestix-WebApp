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
            'Push-ups',
            'Squats',
            'Bench Press',
            'Deadlift',
            'Pull-ups',
            'Lunges',
            'Planks',
            'Burpees',
            'Dumbbell Curls',
            'Shoulder Press',
            'Leg Press',
            'Treadmill Running',
            'Cycling',
            'Rowing',
            'Box Jumps'
        ];

        return [
            'member_id' => Member::factory(),
            'tanggal' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'jenis_latihan' => $this->faker->randomElement($exerciseTypes),
            'catatan_repetisi' => $this->faker->numberBetween(5, 50),
            'catatan_durasi' => $this->faker->numberBetween(10, 120), // dalam menit
            'catatan_berat' => $this->faker->randomFloat(1, 10, 100), // 10-100 kg
        ];
    }
}
