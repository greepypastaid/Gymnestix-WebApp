<?php

namespace App\Models;

// Jika kamu benar-benar pakai Spatie Permission, aktifkan baris ini dan tambahkan ke `use` di bawah
// use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    // Kalau kamu memang pakai Spatie Permission, aktifkan baris berikut:
    // use HasRoles;

    protected $primaryKey = 'user_id'; // ✅ Penting untuk primary key non-standar

    protected $fillable = [
        'nama',
        'email',
        'password',
        'alamat',
        'nomor_telepon',
        'tanggal_lahir',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tanggal_lahir' => 'date',
        ];
    }

    /** RELATIONSHIPS */

    public function trainer()
    {
        return $this->hasOne(Trainer::class, 'user_id', 'user_id');
    }

    public function member()
    {
        return $this->hasOne(Member::class, 'user_id', 'user_id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /** PERMISSIONS HELPERS */

    public function hasPermission(string $permission): bool
    {
        return $this->role?->hasPermission($permission) ?? false;
    }

    public function hasAnyPermission(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }

    public function hasAllPermissions(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if (!$this->hasPermission($permission)) {
                return false;
            }
        }
        return true;
    }

    /** ROLE HELPERS */

    public function getRoleName(): string
    {
        return $this->role?->name ?? 'No Role';
    }

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
}
