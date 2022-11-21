<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Message>
 */
final class MessageFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Message::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'message' => $this->faker->text,
            'discount_id' => $this->faker->randomNumber(),
            'sent_at' => $this->faker->dateTime(),
            'admin_id' => \App\Models\User::factory(),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
