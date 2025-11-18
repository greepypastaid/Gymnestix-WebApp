<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';
    protected $primaryKey = 'class_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'trainer_id',
        'nama_kelas',
        'deskripsi',
        'waktu_mulai',
        'waktu_selesai',
        'durasi',
        'kapasitas',
    ];

    /**
     * Relasi ke Trainer (User)
     */
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }



    /**
     * Relasi ke Member (User) melalui pivot class_user
     */
    public function members()
    {
        return $this->belongsToMany(
            \App\Models\User::class,
            'class_user',   // pivot table
            'class_id',     // FK pivot → class_id
            'member_id'     // FK pivot → member_id (hasil rename)
        )
            ->withPivot(['joined_at', 'expired_at', 'status'])
            ->withTimestamps();
    }
}
