<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole   = DB::table('roles')->where('name', 'admin')->first();
        $trainerRole = DB::table('roles')->where('name', 'trainer')->first();
        $memberRole  = DB::table('roles')->where('name', 'member')->first();

        // Create Admin
        User::create([
            'nama' => 'Super Admin',
            'email' => 'admin@gymnestix.com',
            'alamat' => 'Jl. Kebugaran No. 1, Jakarta',
            'nomor_telepon' => '081234567890',
            'tanggal_lahir' => '1990-01-01',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
        ]);

        // Create Trainer
        User::create([
            'nama' => 'Trainer Budi',
            'email' => 'trainer@gymnestix.com',
            'alamat' => 'Jl. Fitness No. 2, Jakarta',
            'nomor_telepon' => '081234567891',
            'tanggal_lahir' => '1992-05-12',
            'password' => Hash::make('password'),
            'role_id' => $trainerRole->id,
        ]);

        // Create Members (contoh 5 user member)
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'nama' => "Member {$i}",
                'email' => "member{$i}@example.com",
                'alamat' => "Jl. Member No. {$i}, Jakarta",
                'nomor_telepon' => "08123456789{$i}",
                'tanggal_lahir' => '2000-01-01',
                'password' => Hash::make('password'),
                'role_id' => $memberRole->id,
            ]);
        }

        // Tambahan: generate dummy member lain pakai factory
        User::factory(20)->create([
            'role_id' => $memberRole->id,
        ]);
    }
}
