<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipments extends Model
{
    /** @use HasFactory<\Database\Factories\EquipmentsFactory> */
    use HasFactory;

    protected $table = 'equipments'; // Specify table name
    protected $primaryKey = 'equipment_id';
    
    protected $fillable = [
        'nama_alat',
        'kondisi',
        'tanggal_pembelian',
        'jadwal_perawatan',
    ];

    protected $casts = [
        'tanggal_pembelian' => 'date',
        'jadwal_perawatan' => 'date',
    ];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'equipment_id', 'equipment_id');
    }
}
