<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutProgress extends Model
{
    /** @use HasFactory<\Database\Factories\WorkoutProgressFactory> */
    use HasFactory;

    protected $table = 'workout_progresses';
    protected $primaryKey = 'progress_id';
    
    protected $fillable = [
        'member_id',
        'tanggal',
        'jenis_latihan',
        'catatan_repetisi',
        'catatan_durasi',
        'catatan_berat',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'catatan_berat' => 'decimal:2',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }
}
