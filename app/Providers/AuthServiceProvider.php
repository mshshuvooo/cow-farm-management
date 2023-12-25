<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('validate-role', function (User $user, $requiredRole) {
            //Convert user roles object to array
            $user_roles = (array) $user->getRoleNames();
            //Get user role values
            $user_roles = array_values($user_roles)[0];
            return array_intersect($requiredRole, $user_roles);
        });
    }
}
