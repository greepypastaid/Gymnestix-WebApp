<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Trainer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GymClass>
 */
class GymClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ruangans = ['Studio A', 'Studio B', 'Studio C', 'Ruang Fitness', 'Outdoor Arena', 'Gym Hall', 'Yoga Room', 'Cardio Zone'];
        
        return [
            'trainer_id' => Trainer::all()->random()->trainer_id,
            'nama_kelas' => fake()->word(),
            'deskripsi' => fake()->sentence(),
            'ruangan' => fake()->randomElement($ruangans),
            'waktu_mulai' => fake()->time('H:i'),
            'waktu_selesai' => fake()->time('H:i'),
            'durasi' => fake()->numberBetween(30, 120),
            'kapasitas' => fake()->numberBetween(5, 30),
        ];
    }
}
