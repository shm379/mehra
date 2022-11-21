<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UserFollow;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\UserFollow>
 */
final class UserFollowFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = UserFollow::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(),
            'type' => $this->faker->randomElement(['1', '2']),
            'follow_id' => $this->faker->randomNumber(),
        ];
    }
}
