<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'alamat',
        'nomor_telepon',
        'tanggal_lahir',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tanggal_lahir' => 'date',
        ];
    }

    /**
     * Relationship to Trainer
     */
    public function trainer()
    {
        return $this->hasOne(Trainer::class, 'user_id', 'user_id');
    }

    /**
     * Relationship to Member
     */
    public function member()
    {
        return $this->hasOne(Member::class, 'user_id', 'user_id');
    }

    // User belongs to one role
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function attendancesAsMember(): HasMany
    {
        return $this->hasMany(Attendance::class, 'member_id', 'user_id');
    }

    public function attendancesAsTrainer(): HasMany
    {
        return $this->hasMany(Attendance::class, 'trainer_id', 'user_id');
    }


    // Check if user has specific permission
    public function hasPermission(string $permission): bool
    {
        return $this->role?->hasPermission($permission) ?? false;
    }
    // Check if user has any of the given permissions
    public function hasAnyPermission(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }
    // Check if user has all given permissions
    public function hasAllPermissions(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if (!$this->hasPermission($permission)) {
                return false;
            }
        }
        return true;
    }

    // Get user's role name
    public function getRoleName(): string
    {
        return $this->role?->name ?? 'No Role';
    }
    // Helper methods for role checking
    public function isAdmin(): bool
    {
        return $this->getRoleName() === 'admin';
    }
    public function isTrainer(): bool
    {
        return $this->getRoleName() === 'trainer';
    }
    public function isMember(): bool
    {
        return $this->getRoleName() === 'member';
    }

    public function scopeByRole($query, $roleName)
    {
        return $query->whereHas('role', function($q) use ($roleName) {
            $q->where('name', $roleName);
        });
    }

    public function scopeMembers($query)
    {
        return $this->byRole('member');
    }

    public function scopeTrainers($query)
    {
        return $this->byRole('trainer');
    }
}
