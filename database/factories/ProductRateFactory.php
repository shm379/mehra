<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ProductRate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ProductRate>
 */
final class ProductRateFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = ProductRate::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->randomNumber(),
            'rate_id' => $this->faker->randomNumber(),
            'rate' => $this->faker->word,
        ];
    }
}
