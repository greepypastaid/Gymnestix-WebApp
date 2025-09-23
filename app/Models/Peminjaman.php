<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    /** @use HasFactory<\Database\Factories\PeminjamanFactory> */
    use HasFactory;

    protected $primaryKey = 'peminjaman_id';
    
    protected $fillable = [
        'member_id',
        'equipment_id',
        'waktu_pinjam',
        'waktu_kembali',
    ];

    protected $casts = [
        'waktu_pinjam' => 'timestamp',
        'waktu_kembali' => 'timestamp',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipments::class, 'equipment_id', 'equipment_id');
    }
}
