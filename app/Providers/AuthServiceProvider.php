<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Prevent admin user to perform user management related actions on himself
        // todo move this to policy
        Gate::define('manageUsers', function ($authUser, $user) {
            if ($user instanceof \App\Models\User) {
                return !$authUser->is($user);
            }
            return true;
        });
    }
}
