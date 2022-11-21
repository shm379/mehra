<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Order>
 */
final class OrderFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Order::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'discount_id' => \App\Models\Discount::factory(),
            'total_price_without_discount' => $this->faker->randomFloat(),
            'total_price' => $this->faker->randomFloat(),
            'vat' => $this->faker->randomFloat(),
            'status' => $this->faker->randomNumber(),
            'gateway' => $this->faker->randomElement(['کیف پول', 'درگاه پرداخت بانک سامان', 'درگاه پرداخت بانک ملت', 'درگاه پرداخت بانک پارسیان', 'درگاه پرداخت بانک پاسارگاد', 'درگاه پرداخت پی دات آی آر', 'درگاه پرداخت بانک صادرات', 'درگاه پرداخت زرین پال', 'درگاه پرداخت آیدی پی', 'درگاه پرداخت زیبال', 'درگاه پرداخت نکست پی']),
        ];
    }
}
