<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\QuestionAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\QuestionAnswer>
 */
final class QuestionAnswerFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = QuestionAnswer::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'question_id' => $this->faker->randomNumber(),
            'body' => $this->faker->text,
            'status' => $this->faker->randomElement(['1', '2']),
            'parent_id' => $this->faker->randomNumber(),
        ];
    }
}
