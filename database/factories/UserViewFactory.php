<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UserView;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\UserView>
 */
final class UserViewFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = UserView::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(),
            'model_type' => $this->faker->word,
            'model_id' => $this->faker->randomNumber(),
            'count' => $this->faker->randomNumber(),
        ];
    }
}
