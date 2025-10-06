<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';
    protected $primaryKey = 'attendance_id';
    public $timestamps = true;

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
        'durasi_latihan' => 'integer',
    ];

    /**
     * Relationship to Member model
     */
    public function member(): BelongsTo
    {
        // assume members table PK is member_id
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
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
