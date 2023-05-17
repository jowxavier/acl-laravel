<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Permission;
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
        if ($this->app->runningInConsole()) {
            return;
        }

        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            Gate::define($permission->name, function (User $user) use ($permission) {
                return $user->hasPermissions($permission->name);
            });
        }

        Gate::before(function (User $user) {
            if ($user->isAdmin()) {
                return true;
            }
        });
    }
}
