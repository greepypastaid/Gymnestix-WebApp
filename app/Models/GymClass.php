<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymClass extends Model
{
    /** @use HasFactory<\Database\Factories\GymClassFactory> */
    use HasFactory;

    protected $table = 'classes';
    protected $primaryKey = 'class_id';
    
    protected $fillable = [
        'trainer_id',
        'nama_kelas',
        'deskripsi',
        'waktu_mulai',
        'waktu_selesai',
        'durasi',
        'kapasitas',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime:H:i',
        'waktu_selesai' => 'datetime:H:i',
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'trainer_id', 'trainer_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'class_id', 'class_id');
    }

    /**
     * Convenience many-to-many relation to members through bookings
     */
    public function members()
    {
        return $this->belongsToMany(
            \App\Models\Member::class,
            'bookings',
            'class_id',
            'member_id'
        )->withPivot('tanggal_booking')->withTimestamps();
    }
}
