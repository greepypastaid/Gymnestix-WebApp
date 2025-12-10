<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GymClass;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClassReminderMail;

class SendClassReminderCommand extends Command
{
    protected $signature = 'reminder:class';
    protected $description = 'Kirim email reminder kelas H-1 dan H';

    public function handle()
    {
        $today    = Carbon::now();
        $tomorrow = Carbon::now()->addDay();

        // ambil semua kelas
        $classes = GymClass::with(['bookings.member.user'])->get();

        foreach ($classes as $class) {

            // mapping hari → index
            $dayIndex = [
                'minggu' => 0,
                'senin' => 1,
                'selasa' => 2,
                'rabu' => 3,
                'kamis' => 4,
                'jumat' => 5,
                'sabtu' => 6,
            ];

            $classDayNum = $dayIndex[strtolower($class->hari)] ?? null;
            if ($classDayNum === null) continue;

            // cari tanggal actual minggu ini
            $classDate = $today->copy()->startOfWeek()->addDays($classDayNum);

            // jika sudah lewat minggu ini, berarti minggu depan
            if ($classDate->isPast()) {
                $classDate->addWeek();
            }

            // jika besok → kirim H-1
            if ($classDate->isSameDay($tomorrow)) {
                $this->sendReminder($class, 'H-1', $classDate);
            }

            // jika hari ini → kirim H
            if ($classDate->isSameDay($today)) {
                $this->sendReminder($class, 'H', $classDate);
            }
        }

        return Command::SUCCESS;
    }

    private function sendReminder($class, $type, $date)
    {
        foreach ($class->bookings as $booking) {

            // if ($booking->status !== 'confirmed') continue;
            if (!$booking->member || !$booking->member->user) continue;

            $user = $booking->member->user;

            Mail::to($user->email)->queue(
                new ClassReminderMail($user, $class, $type, $date)
            );
        }
    }
}
