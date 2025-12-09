<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Member;
use App\Models\GymClass;
use App\Models\ClassSchedule;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';
    protected $primaryKey = 'attendance_id';
    public $timestamps = true;

    // Support both legacy Indonesian field names and the newer English names used
    // by controllers/views. This keeps mass-assignment working regardless of
    // which form (old/new) created the attendance row.
    protected $fillable = [
        // ids
        'user_id', 'member_id', 'trainer_id', 'class_id', 'class_schedule_id',
        // dates / times (both language variants)
        'attendance_date', 'tanggal', 'check_in_at', 'waktu_masuk', 'check_out_at', 'waktu_keluar',
        // durations
        'duration', 'durasi_latihan',
        // meta
        'status', 'notes', 'catatan', 'recorded_by',
    ];

    protected $casts = [
        // dates
        'attendance_date' => 'date',
        'tanggal' => 'date',
        // datetimes
        'check_in_at' => 'datetime',
        'waktu_masuk' => 'datetime',
        'check_out_at' => 'datetime',
        'waktu_keluar' => 'datetime',
        // ints
        'duration' => 'integer',
        'durasi_latihan' => 'integer',
    ];

    /**
     * Relationship to Member model
     */
    public function member(): BelongsTo
    {
        // relation to Member model (if stored as member_id)
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
    public function gymClass(): BelongsTo
    {
        return $this->belongsTo(GymClass::class, 'class_id', 'class_id');
    }

    public function user(): BelongsTo
    {
        // Primary user relation (admins create records with user_id)
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function schedule(): BelongsTo
    {
        // Relation to ClassSchedule (if attendance references a scheduled session)
        return $this->belongsTo(ClassSchedule::class, 'class_schedule_id', 'id');
    }
}
