<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ambil data kosong dlu buat dijadiin member
        $availableUsers = User::whereDoesntHave('member')->get();
        
        // Buat member dari user yang sudah ada
        foreach ($availableUsers->take(15) as $user) {
            Member::create([
                'user_id' => $user->user_id,
                'tanggal_registrasi' => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
                'status_keanggotaan' => fake()->randomElement(['Aktif', 'Tidak Aktif', 'Dibekukan']),
            ]);
        }
    }
}
