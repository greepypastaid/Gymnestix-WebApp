<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    /** @use HasFactory<\Database\Factories\MembershipPlanFactory> */
    use HasFactory;

    protected $primaryKey = 'plan_id';

    protected $fillable = [
        'nama_plan',
        'harga',
        'deskripsi',
        'periode_bulan',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function billings()
    {
        return $this->hasMany(Billing::class, 'plan_id', 'plan_id');
    }
}
