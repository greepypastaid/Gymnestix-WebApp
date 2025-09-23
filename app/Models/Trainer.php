<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    /** @use HasFactory<\Database\Factories\TrainerFactory> */
    use HasFactory;

     protected $primaryKey = 'trainer_id';
    
    protected $fillable = [
        'user_id',
        'spesialisasi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function classes()
    {
        return $this->hasMany(GymClass::class, 'trainer_id', 'trainer_id');
    }
}
