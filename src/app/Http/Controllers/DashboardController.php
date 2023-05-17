<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Product;
use App\Models\Category;
use App\Models\Permission;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalUsers = User::tenantUser()->count();
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalTenants = Tenant::myTenant()->count();
        $totalRoles = Role::count();
        $totalPermissions = Permission::count();

        return view('dashboard', compact(
            'totalUsers',
            'totalCategories',
            'totalProducts',
            'totalTenants',
            'totalRoles',
            'totalPermissions'
        ));
    }
}
