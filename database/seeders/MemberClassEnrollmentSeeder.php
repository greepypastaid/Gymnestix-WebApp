<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\GymClass;
use App\Models\Member;
use App\Models\Booking;

class MemberClassEnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = Member::all();
        $classes = GymClass::all();

        if ($members->isEmpty() || $classes->isEmpty()) {
            return;
        }

        DB::transaction(function () use ($members, $classes) {
            foreach ($classes as $class) {
                $capacity = (int) ($class->kapasitas ?? $class->capacity ?? 10);
                $capacity = max(1, $capacity);

                $maxEnroll = min($capacity, $members->count());
                $enrollCount = rand(1, $maxEnroll);

                $selected = $members->random($enrollCount);

                foreach ($selected as $member) {
                    Booking::firstOrCreate(
                        [
                            'member_id' => $member->member_id,
                            'class_id' => $class->class_id,
                        ],
                        [
                            'tanggal_booking' => now()->subDays(rand(0, 30)),
                        ]
                    );
                }
            }
        });
    }
}
