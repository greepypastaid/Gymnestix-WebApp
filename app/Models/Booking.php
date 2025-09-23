<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    protected $primaryKey = 'booking_id';
    
    protected $fillable = [
        'member_id',
        'class_id',
        'tanggal_booking',
    ];

    protected $casts = [
        'tanggal_booking' => 'timestamp',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }

    public function class()
    {
        return $this->belongsTo(GymClass::class, 'class_id', 'class_id');
    }
}
