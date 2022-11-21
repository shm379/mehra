<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Comment>
 */
final class CommentFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Comment::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'order_id' => $this->faker->randomNumber(),
            'body' => $this->faker->text,
            'product_id' => $this->faker->randomNumber(),
            'parent_id' => $this->faker->randomNumber(),
            'rate' => $this->faker->randomFloat(),
            'status' => $this->faker->randomNumber(),
            'is_anonymous' => $this->faker->boolean,
            'admin_id' => $this->faker->randomElement(['1']),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
