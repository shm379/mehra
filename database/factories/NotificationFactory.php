<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Notification>
 */
final class NotificationFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Notification::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'notifier_id' => $this->faker->randomNumber(),
            'actor_id' => \App\Models\User::factory(),
            'message_id' => $this->faker->randomNumber(),
            'object_id' => $this->faker->randomNumber(),
            'object_type' => $this->faker->word,
            'activity_type' => $this->faker->word,
            'message' => $this->faker->text,
            'sent_at' => $this->faker->dateTime(),
            'read_at' => $this->faker->dateTime(),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
