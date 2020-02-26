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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // admin, editor, author, member
        Gate::define('gate-in-view', function () {
            return true;  // cần trả về true or false
        });

        Gate::define('gate-in-route', function () {
            return true;
        });

        Gate::define('gate-in-controller', function () {
            return true;
        });

        Gate::define('is-admin', function ($user) {
            // $user: dang login
            return $user->email === 'admin@gmail.com';  // cần trả về true or false
        });
    }
}
