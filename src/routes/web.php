<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('auth')->group(function() {
    /**
     * Rotas de Regras x Permissões
     */
    Route::middleware(['can:roles', 'can:permissions'])->group(function() {
        Route::any('cargo/{id}/permissoes/buscar', 'RolePermissionController@search')->name('admin.roles.permissions.search');
        Route::any('cargo/{id}/permissoes/novo/buscar', 'RolePermissionController@create')->name('admin.roles.permissions.create.search');
        Route::resource('cargo/{id}/permissoes', 'RolePermissionController')->names([
            'index' => 'admin.roles.permissions.index',
            'create' => 'admin.roles.permissions.create',
            'store' => 'admin.roles.permissions.store',
            'destroy' => 'admin.roles.permissions.destroy',
        ])->only([
            'index', 'create', 'store', 'destroy'
        ]);
    });

    /**
     * Rotas de Regras
     */
    Route::middleware('can:roles')->group(function() {
        Route::any('cargos/buscar', 'RoleController@search')->name('admin.roles.search');
        Route::resource('cargos', 'RoleController')->names([
            'index' => 'admin.roles.index',
            'create' => 'admin.roles.create',
            'store' => 'admin.roles.store',
            'show' => 'admin.roles.show',
            'edit' => 'admin.roles.edit',
            'update' => 'admin.roles.update',
            'destroy' => 'admin.roles.destroy',
        ]);
    });

    /**
     * Rotas de Tenants "Empresas"
     */
    Route::middleware('can:tenants')->group(function() {
        Route::any('empresas/buscar', 'TenantController@search')->name('admin.tenants.search');
        Route::get('/logar/empresa/{id}', 'TenantController@sigin')->name('admin.tenants.sigin');
        Route::resource('empresas', 'TenantController')->names([
            'index' => 'admin.tenants.index',
            'create' => 'admin.tenants.create',
            'store' => 'admin.tenants.store',
            'show' => 'admin.tenants.show',
            'edit' => 'admin.tenants.edit',
            'update' => 'admin.tenants.update',
            'destroy' => 'admin.tenants.destroy',
        ]);
    });

    /**
     * Rotas de Usuários x Cargos
     */
    Route::middleware('can:users')->group(function() {
        Route::any('usuario/{id}/cargos/buscar', 'UserRoleController@search')->name('admin.users.roles.search');
        Route::any('usuario/{id}/cargos/novo/buscar', 'UserRoleController@create')->name('admin.users.roles.create.search');
        Route::resource('usuario/{id}/cargos', 'UserRoleController')->names([
            'index' => 'admin.users.roles.index',
            'create' => 'admin.users.roles.create',
            'store' => 'admin.users.roles.store',
            'destroy' => 'admin.users.roles.destroy',
        ])->only([
            'index', 'create', 'store', 'destroy'
        ]);
    });

    /**
     * Rotas de Usuários
     */
    Route::middleware('can:users')->group(function() {
        Route::any('usuarios/buscar', 'UserController@search')->name('admin.users.search');
        Route::resource('usuarios', 'UserController')->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'show' => 'admin.users.show',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]);
    });

    /**
     * Rotas de Permissão
     */
    Route::middleware('can:permissions')->group(function() {
        Route::any('permissoes/buscar', 'PermissionController@search')->name('admin.permissions.search');
        Route::resource('permissoes', 'PermissionController')->names([
            'index' => 'admin.permissions.index',
            'create' => 'admin.permissions.create',
            'store' => 'admin.permissions.store',
            'show' => 'admin.permissions.show',
            'edit' => 'admin.permissions.edit',
            'update' => 'admin.permissions.update',
            'destroy' => 'admin.permissions.destroy',
        ]);
    });

    /**
     * Rotas de Categorias
     */
    Route::middleware('can:categories')->group(function() {
        Route::any('categorias/buscar', 'CategoryController@search')->name('admin.categories.search');
        Route::resource('categorias', 'CategoryController')->names([
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'store' => 'admin.categories.store',
            'show' => 'admin.categories.show',
            'edit' => 'admin.categories.edit',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
        ]);
    });

    /**
     * Rotas de Produtos x Categorias
     */
    Route::middleware('can:products')->group(function() {
        Route::any('produto/{id}/categorias/buscar', 'CategoryProductController@search')->name('admin.products.categories.search');
        Route::any('produto/{id}/categorias/novo/buscar', 'CategoryProductController@create')->name('admin.products.categories.create.search');
        Route::resource('produto/{id}/categorias', 'CategoryProductController')->names([
            'index' => 'admin.products.categories.index',
            'create' => 'admin.products.categories.create',
            'store' => 'admin.products.categories.store',
            'destroy' => 'admin.products.categories.destroy',
        ])->only([
            'index', 'create', 'store', 'destroy'
        ]);
    });

    /**
     * Rotas de Produtos
     */
    Route::middleware('can:products')->group(function() {
        Route::any('produtos/buscar', 'ProductController@search')->name('admin.products.search');
        Route::resource('produtos', 'ProductController')->names([
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'store' => 'admin.products.store',
            'show' => 'admin.products.show',
            'edit' => 'admin.products.edit',
            'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy',
        ]);
    });

    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
});

/**
 * Rotas do site
 */
Route::get('/', function() {
    return view('auth.login');
});

/**
 * Rotas de Autenticação
 */
Auth::routes(['register' => false]);
