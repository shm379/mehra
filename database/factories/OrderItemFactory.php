<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\OrderItem>
 */
final class OrderItemFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = OrderItem::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'order_id' => $this->faker->randomNumber(),
            'price_without_discount' => $this->faker->randomFloat(),
            'price' => $this->faker->randomFloat(),
            'quantity' => $this->faker->randomNumber(),
            'total_price_without_discount' => $this->faker->randomFloat(),
            'total_price' => $this->faker->randomFloat(),
            'line_item_type' => $this->faker->word,
            'line_item_id' => $this->faker->randomNumber(),
        ];
    }
}
