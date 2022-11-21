<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ProductDiscount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ProductDiscount>
 */
final class ProductDiscountFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = ProductDiscount::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->randomNumber(),
            'discount_id' => $this->faker->randomNumber(),
        ];
    }
}
