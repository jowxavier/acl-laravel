<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tenant_id' => Tenant::first(),
            'name' => 'Jonathan Xavier Ribeiro',
            'email' => 'jonathanxribeiro@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('xavier'),
            'remember_token' => Str::random(10),
        ];
    }
}
