<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    protected $fillable = [
        'class_name', 'class_date', 'start_time', 'end_time', 'room'
    ];

    protected $casts = [
        'class_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time'   => 'datetime:H:i',
    ];

    public function assignments() {
        return $this->hasMany(TrainerAssignment::class);
    }
}
