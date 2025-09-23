<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    /** @use HasFactory<\Database\Factories\BillingFactory> */
    use HasFactory;

    protected $primaryKey = 'billing_id';
    
    protected $fillable = [
        'member_id',
        'plan_id',
        'jumlah',
        'tanggal_tagihan',
        'tanggal_jatuh_tempo',
        'status_pembayaran',
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'tanggal_tagihan' => 'date',
        'tanggal_jatuh_tempo' => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }

    public function membershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class, 'plan_id', 'plan_id');
    }
}
