<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'tenants',
                'description' => 'Menu de Empresas'
            ],
            [
                'name' => 'permissions',
                'description' => 'Menu de Permissões'
            ],
            [
                'name' => 'roles',
                'description' => 'Menu de Cargos'
            ],
            [
                'name' => 'users',
                'description' => 'Menu de Usuários'
            ],
            [
                'name' => 'categories',
                'description' => 'Menu de categorias'
            ],
            [
                'name' => 'products',
                'description' => 'Menu de produtos'
            ]
        ];

        foreach($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
