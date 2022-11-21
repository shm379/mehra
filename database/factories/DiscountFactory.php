<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Discount>
 */
final class DiscountFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Discount::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['1', '2']),
            'code' => $this->faker->word,
            'generated_by' => $this->faker->randomElement(['1', '2']),
            'start_time' => $this->faker->dateTime(),
            'end_time' => $this->faker->dateTime(),
            'capacity' => $this->faker->randomNumber(),
            'all_products' => $this->faker->randomNumber(),
            'used_count' => $this->faker->randomNumber(),
            'per_user' => $this->faker->randomNumber(),
            'percent' => $this->faker->randomNumber(),
            'amount' => $this->faker->randomNumber(),
            'min_cart_total' => $this->faker->randomNumber(),
            'max_cart_total' => $this->faker->randomNumber(),
            'title' => $this->faker->title,
            'description' => $this->faker->text,
            'is_active' => $this->faker->boolean,
            'first_buy' => $this->faker->boolean,
            'limit_users' => $this->faker->boolean,
            'expire_at' => $this->faker->dateTime(),
            'admin_id' => $this->faker->randomElement(['1']),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
