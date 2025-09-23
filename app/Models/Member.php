<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use HasFactory;

    protected $primaryKey = 'member_id';

    protected $fillable = [
        'user_id',
        'tanggal_registrasi',
        'status_keanggotaan',
    ];

    protected $casts = [
        'tanggal_registrasi' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function billings()
    {
        return $this->hasMany(Billing::class, 'member_id', 'member_id');
    }

    public function workoutProgresses()
    {
        return $this->hasMany(WorkoutProgress::class, 'member_id', 'member_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'member_id', 'member_id');
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'member_id', 'member_id');
    }
}
