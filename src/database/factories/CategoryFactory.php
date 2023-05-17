<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

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
            'description' => $this->faker->text,
        ];
    }
}
