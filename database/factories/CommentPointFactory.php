<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CommentPoint;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CommentPoint>
 */
final class CommentPointFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = CommentPoint::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'comment_id' => $this->faker->randomNumber(),
            'title' => $this->faker->title,
            'status' => $this->faker->randomElement(['1', '2']),
        ];
    }
}
