<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'class_schedule_id',
        'attendance_date',
        'check_in_at',
        'check_out_at',
        'status',
        'recorded_by',
        'notes',
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'check_in_at'     => 'datetime',
        'check_out_at'    => 'datetime',
    ];

    public function user(): BelongsTo
    {
        // relasi ke Users.user_id
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function recorder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by', 'user_id');
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(ClassSchedule::class, 'class_schedule_id');
    }
}
