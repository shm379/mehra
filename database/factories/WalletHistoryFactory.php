<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\WalletHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\WalletHistory>
 */
final class WalletHistoryFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = WalletHistory::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'wallet_id' => $this->faker->randomNumber(),
            'amount' => $this->faker->randomFloat(),
            'status' => $this->faker->randomNumber(),
            'admin_id' => $this->faker->randomElement(['1']),
        ];
    }
}
