<?php

namespace App\Jobs;

use App\Models\Booking;
use App\Models\GymClass;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessBooking implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $classId;
    public $memberId;

    // retry & timeout settings
    public $tries = 3;       // coba ulang 3x kalau gagal
    public $timeout = 120;   // maksimal eksekusi job (detik)

    public function __construct($classId, $memberId)
    {
        $this->classId = $classId;
        $this->memberId = $memberId;
    }

    public function handle()
    {
        DB::transaction(function () {
            $class = GymClass::where('class_id', $this->classId)->lockForUpdate()->first();

            if (!$class) {
                return;
            }

            // Chek ulang member
            $already = Booking::where('member_id', $this->memberId)
                ->where('class_id', $this->classId)
                ->exists();
            if ($already) {
                return;
            }

            // Hitung dan compare ama kapasitas
            $joinedCount = Booking::where('class_id', $this->classId)->lockForUpdate()->count();
            if ($joinedCount >= (int) $class->kapasitas) {
                // class is full
                return;
            }

            // Create booking
            Booking::create([
                'member_id' => $this->memberId,
                'class_id' => $this->classId,
                'tanggal_booking' => now(),
            ]);
        }, 5); // retry 5x if deadlock
    }

    public function failed(\Throwable $exception)
    {
        Log::error('ProcessBooking failed', ['class' => $this->classId, 'member' => $this->memberId, 'err' => $exception->getMessage()]);
    }
}