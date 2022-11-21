<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Question>
 */
final class QuestionFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Question::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(),
            'product_id' => $this->faker->randomNumber(),
            'body' => $this->faker->text,
            'parent_id' => $this->faker->randomNumber(),
            'status' => $this->faker->randomElement(['1', '2']),
            'admin_id' => $this->faker->randomElement(['1']),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
