<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class TenantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tenant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cnpj' => $this->faker->cnpj(false),
            'company' => $this->faker->company,
            'url' => $this->faker->url,
            'email' => $this->faker->freeEmail,
            'logo' => 'http://lorempixel.com.br/400/400',
            'manager' => true,
        ];
    }
}
