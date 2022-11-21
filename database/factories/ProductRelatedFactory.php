<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ProductRelated;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ProductRelated>
 */
final class ProductRelatedFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = ProductRelated::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->randomNumber(),
            'related_id' => $this->faker->randomNumber(),
            'order' => $this->faker->randomNumber(),
            'type' => $this->faker->randomNumber(),
        ];
    }
}
