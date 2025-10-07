<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Member;
use App\Models\GymClass;
use App\Models\Booking;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class TestMembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the Itaque class or create it if it doesn't exist
        $gymClass = GymClass::where('nama_kelas', 'Itaque')->firstOrFail();

        // Test member data
        $members = [
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@example.com',
                'phone' => '081234567890',
                'address' => 'Jl. Merdeka No. 123, Jakarta',
                'birth_date' => '1995-03-15',
            ],
            [
                'name' => 'Michael Chen',
                'email' => 'michael.chen@example.com',
                'phone' => '082345678901',
                'address' => 'Jl. Sudirman No. 45, Jakarta',
                'birth_date' => '1992-07-22',
            ],
            [
                'name' => 'Rina Wijaya',
                'email' => 'rina.wijaya@example.com',
                'phone' => '083456789012',
                'address' => 'Jl. Gatot Subroto No. 67, Jakarta',
                'birth_date' => '1998-11-30',
            ],
        ];

        DB::transaction(function () use ($members, $gymClass) {
            foreach ($members as $memberData) {
                // Create user account
                $user = User::create([
                    'name' => $memberData['name'],
                    'email' => $memberData['email'],
                    'password' => Hash::make('password123'), // Common test password
                ]);

                // Assign member role
                $user->assignRole('member');

                // Create member profile
                $member = Member::create([
                    'user_id' => $user->id,
                    'nama' => $memberData['name'],
                    'email' => $memberData['email'],
                    'nomor_telepon' => $memberData['phone'],
                    'alamat' => $memberData['address'],
                    'tanggal_lahir' => $memberData['birth_date'],
                    'status' => 'active',
                ]);

                // Create booking for the Itaque class
                Booking::create([
                    'member_id' => $member->member_id,
                    'class_id' => $gymClass->class_id,
                    'status' => 'confirmed',
                    'tanggal_booking' => now(),
                ]);
            }
        });

        $this->command->info('Test members created and enrolled in Itaque class successfully!');
        $this->command->info('Test account password: password123');
    }
}