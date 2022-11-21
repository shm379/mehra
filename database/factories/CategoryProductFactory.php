<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CategoryProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CategoryProduct>
 */
final class CategoryProductFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = CategoryProduct::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'category_id' => $this->faker->randomNumber(),
            'product_id' => $this->faker->randomNumber(),
        ];
    }
}
