<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'membership_plan_id',
        'external_id',
        'va_number',
        'amount',
        'status',
        'payment_method',
        'payment_url',
        'expired_at',
        'paid_at',
        'membership_plan_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function membershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class, 'membership_plan_id', 'plan_id');
    }
}
