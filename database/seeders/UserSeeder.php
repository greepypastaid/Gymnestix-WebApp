<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'nama' => 'Test User',
            'email' => 'test@example.com',
            'alamat' => 'Jl. Test No. 1, Jakarta',
            'nomor_telepon' => '+6289876543210',
            'tanggal_lahir' => '1995-01-01',
            'password' => Hash::make('12345678'),
        ]);

        User::factory()->create([
            'nama' => 'greepzid',
            'email' => 'reka@gmail.com',
            'alamat' => 'Jl. Test No. 1, Jakarta',
            'nomor_telepon' => '+6289876543210',
            'tanggal_lahir' => '1995-01-01',
            'password' => Hash::make('12345678'),
        ]);

        User::factory(25)->create();
    }
}
