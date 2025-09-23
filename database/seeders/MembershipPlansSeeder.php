<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipPlansSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('membership_plans')->insert([
            [
                'nama_plan' => 'Basic',
                'deskripsi' => 'Akses gym reguler',
                'periode_bulan' => 1,
                'harga' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_plan' => 'Premium',
                'deskripsi' => 'Akses semua kelas + gym 24 jam',
                'periode_bulan' => 12,
                'harga' => 900000,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
