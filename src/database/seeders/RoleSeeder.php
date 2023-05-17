<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            'name' => 'Distribuidor',
            'description' => 'Seller Center Distribuidor',
            'manager' => true
        ];

        Role::create($role);
    }
}
