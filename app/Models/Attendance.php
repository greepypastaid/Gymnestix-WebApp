<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $primaryKey = 'attendance_id';

    protected $fillable = [
        'member_id',
        'trainer_id',
        'class_id',
        'tanggal',
        'waktu_masuk',
        'waktu_keluar',
        'durasi_latihan',
        'catatan',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu_masuk' => 'datetime',
        'waktu_keluar' => 'datetime',
        'durasi_latihan' => 'integer', // dalam menit
    ];

    /**
     * Relationship to Member (User)
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(User::class, 'member_id', 'user_id');
    }

    /**
     * Relationship to Trainer (User)
     */
    public function trainer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'trainer_id', 'user_id');
    }

    /**
     * Relationship to GymClass
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(GymClass::class, 'class_id', 'class_id');
    }
}