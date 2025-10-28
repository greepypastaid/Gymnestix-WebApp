<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public const HOME = "/";
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // Admin bypass SEMUA gate
        Gate::before(function ($user, string $ability) {
            if (method_exists($user, 'isAdmin') && $user->isAdmin()) {
                return true;
            }
            return null;
        });

        // Ability definitions (tanpa cek admin lagi)
        Gate::define('schedule.assign_trainer', fn ($user) =>
            method_exists($user,'hasPermission') && $user->hasPermission('schedule.assign_trainer'));

        Gate::define('attendance.track', fn ($user) =>
            method_exists($user,'hasPermission') && $user->hasPermission('attendance.track'));

        Gate::define('equipment.manage', fn ($user) =>
            method_exists($user,'hasPermission') && $user->hasPermission('equipment.manage'));

        Gate::define('equipment.view_all', fn ($user) =>
            method_exists($user,'hasPermission') && $user->hasPermission('equipment.view_all'));

        Gate::define('workout.manage', fn ($user) =>
            method_exists($user,'hasPermission') && $user->hasPermission('workout.manage'));
    }
}
