<?php

namespace Database\Factories;

use App\Models\Tenant;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tenant_id' => Tenant::first(),
            'name' => $this->faker->unique()->word(),
            'price' => $this->faker->randomFloat(5, 0, 20),
            'path' => 'http://lorempixel.com.br/400/400',
            'description' => $this->faker->text,
        ];
    }
}
