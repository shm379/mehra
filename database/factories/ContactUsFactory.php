<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ContactUs;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ContactUs>
 */
final class ContactUsFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = ContactUs::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(),
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'mobile' => $this->faker->word,
            'subject' => $this->faker->title,
            'description' => $this->faker->text,
            'is_read' => $this->faker->boolean,
            'read_at' => $this->faker->dateTime(),
        ];
    }
}
