<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainerAssignment extends Model
{
    protected $fillable = [
        'class_schedule_id', 'trainer_id', 'assigned_by', 'notes'
    ];

    public function schedule() {
        return $this->belongsTo(ClassSchedule::class, 'class_schedule_id');
    }

    public function trainer() {
        return $this->belongsTo(\App\Models\User::class, 'trainer_id');
    }

    public function assigner() {
        return $this->belongsTo(\App\Models\User::class, 'assigned_by');
    }
}
