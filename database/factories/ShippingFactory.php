<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Shipping;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Shipping>
 */
final class ShippingFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Shipping::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'price' => $this->faker->randomFloat(),
        ];
    }
}
