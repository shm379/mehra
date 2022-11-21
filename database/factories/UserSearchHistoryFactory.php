<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UserSearchHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\UserSearchHistory>
 */
final class UserSearchHistoryFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = UserSearchHistory::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'user_id' => $this->faker->randomNumber(),
        ];
    }
}
