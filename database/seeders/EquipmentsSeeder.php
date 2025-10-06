<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipments;
use Carbon\Carbon;

class EquipmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $items = [
            [
                'nama_alat' => 'Treadmill X100',
                'kondisi' => 'Baik',
                'tanggal_pembelian' => $now->subYears(2)->toDateString(),
                'jadwal_perawatan' => $now->addMonths(3)->toDateString(),
            ],
            [
                'nama_alat' => 'Stationary Bike Pro',
                'kondisi' => 'Baik',
                'tanggal_pembelian' => $now->subYears(1)->toDateString(),
                'jadwal_perawatan' => $now->addMonths(6)->toDateString(),
            ],
            [
                'nama_alat' => 'Rowing Machine R200',
                'kondisi' => 'Perlu Perbaikan',
                'tanggal_pembelian' => $now->subYears(3)->toDateString(),
                'jadwal_perawatan' => $now->addMonths(1)->toDateString(),
            ],
            [
                'nama_alat' => 'Elliptical E9',
                'kondisi' => 'Baik',
                'tanggal_pembelian' => $now->subMonths(18)->toDateString(),
                'jadwal_perawatan' => $now->addMonths(4)->toDateString(),
            ],
            [
                'nama_alat' => 'Leg Press 3000',
                'kondisi' => 'Baik',
                'tanggal_pembelian' => $now->subYears(4)->toDateString(),
                'jadwal_perawatan' => $now->addMonths(2)->toDateString(),
            ],
        ];

        foreach ($items as $item) {
            Equipments::updateOrCreate(
                ['nama_alat' => $item['nama_alat']],
                $item
            );
        }
    }
}
