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
    public function users()
    {
        return $this->belongsToMany(
            \App\Models\User::class,
            'class_user',  // nama tabel pivot
            'class_id',    // foreign key di tabel pivot untuk class
            'user_id'      // foreign key di tabel pivot untuk user
        )->withPivot(['membership_plan_id', 'joined_at', 'expired_at', 'status'])
            ->withTimestamps();
    }
}
