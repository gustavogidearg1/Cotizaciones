<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->registerPolicies();

        // Define el gate para administradores
        Gate::define('admin', function ($user) {
            return $user->role_id === Role::ADMIN;
        });
    }


}
