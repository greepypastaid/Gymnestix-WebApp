<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use HasFactory;

    protected $primaryKey = 'member_id';

    protected $fillable = [
        'user_id',
        'tanggal_registrasi',
        'status_keanggotaan',
        'membership_plan_id',
        'expired_at',
    ];

    protected $casts = [
        'tanggal_registrasi' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function billings()
    {
        return $this->hasMany(Billing::class, 'member_id', 'member_id');
    }

    public function workoutProgresses()
    {
        return $this->hasMany(WorkoutProgress::class, 'member_id', 'member_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'member_id', 'member_id');
    }

    public function attendances()
    {
        return $this->hasMany(\App\Models\Attendance::class, 'member_id', 'user_id');
    }

    public function membershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class, 'membership_plan_id', 'plan_id');
    }


    /**
     * Convenience many-to-many relation to classes through bookings
     * Access with $member->classes and $member->classes()->attach()/detach() if needed.
     */
    public function classes()
    {
        return $this->belongsToMany(
            \App\Models\ClassModel::class,
            'class_user',
            'member_id',
            'class_id'
        )->withPivot(['joined_at', 'expired_at', 'status'])
            ->withTimestamps();
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'member_id', 'member_id');
    }
}
