<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Tenant;
use App\Models\Product;
use App\Models\Category;
use App\Observers\TenantObserver;
use App\Observers\ProductObserver;
use App\Observers\CategoryObserver;
use App\Tenant\Manager;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Route::resourceVerbs([
            'create' => 'novo',
            'edit' => 'editar',
        ]);

        Tenant::observe(TenantObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);

        Blade::if('isPermission', function ($permission) {
            $user = User::find(auth()->user()->id);
            return $user->hasPermissions($permission);
        });

        Blade::if('isManager', function (Manager $manager) {
            return $manager->isManager();
        });
    }
}
