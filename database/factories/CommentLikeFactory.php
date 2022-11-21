<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CommentLike;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CommentLike>
 */
final class CommentLikeFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = CommentLike::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'comment_id' => $this->faker->randomNumber(),
            'user_id' => $this->faker->randomNumber(),
            'is_dislike' => $this->faker->boolean,
            'value' => $this->faker->word,
            'metadata' => $this->faker->word,
        ];
    }
}
