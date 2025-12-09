<?php

namespace App\Models;

// Jika kamu benar-benar pakai Spatie Permission, aktifkan baris ini dan tambahkan ke `use` di bawah
// use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'profile_photo',
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

    public function scopeByRole($query, $roleName)
    {
        return $query->whereHas('role', function ($q) use ($roleName) {
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

    public function getProfilePhotoUrlAttribute()
    {
        // Jika profile_photo kosong, return default
        if (empty($this->profile_photo)) {
            return asset('images/default-avatar.png');
        }

        // Jika sudah berupa URL lengkap (http/https), return langsung
        if (str_starts_with($this->profile_photo, 'http')) {
            return $this->profile_photo;
        }

        // Coba cek di Storage disk 'public'
        if (Storage::disk('public')->exists($this->profile_photo)) {
            return asset('storage/' . $this->profile_photo);
        }

        // Fallback ke public/storage/ jika file ada
        $path = public_path('storage/' . $this->profile_photo);
        if (file_exists($path)) {
            return asset('storage/' . $this->profile_photo);
        }

        // Jika tidak ada, return default
        return asset('images/GymnestixLogo.png');
    }
}
