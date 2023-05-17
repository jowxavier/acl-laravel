<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\Contracts\UserRepositoryInterface::class, \App\Repositories\Eloquent\UserRepository::class);
        $this->app->bind(\App\Repositories\Contracts\TenantRepositoryInterface::class, \App\Repositories\Eloquent\TenantRepository::class);
        $this->app->bind(\App\Repositories\Contracts\CategoryRepositoryInterface::class, \App\Repositories\Eloquent\CategoryRepository::class);
        $this->app->bind(\App\Repositories\Contracts\ProductRepositoryInterface::class, \App\Repositories\Eloquent\ProductRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
