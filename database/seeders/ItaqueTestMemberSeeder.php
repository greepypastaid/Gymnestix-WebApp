<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Member;
use App\Models\GymClass;
use App\Models\Booking;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ItaqueTestMemberSeeder extends Seeder
{
    public function run()
    {
        // Create a test member with user account
        $user = User::create([
            'name' => 'Test Member',
            'email' => 'testmember@example.com',
            'password' => Hash::make('password123')
        ]);

        // Make sure the member role exists
        $memberRole = Role::firstOrCreate(['name' => 'member']);
        $user->assignRole($memberRole);

        // Create member profile
        $member = Member::create([
            'user_id' => $user->id,
            'nama' => 'Test Member',
            'email' => 'testmember@example.com',
            'nomor_telepon' => '081234567890',
            'alamat' => 'Jl. Test No. 123',
            'tanggal_lahir' => '1995-01-01',
            'status' => 'active'
        ]);

        // Get the Itaque class
        $class = GymClass::where('nama_kelas', 'Itaque')->first();
        
        if ($class) {
            // Create booking for the class
            Booking::create([
                'member_id' => $member->member_id,
                'class_id' => $class->class_id,
                'status' => 'confirmed',
                'tanggal_booking' => now()
            ]);
        }
    }
}