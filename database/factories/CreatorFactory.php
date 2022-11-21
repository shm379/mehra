<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Creator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Creator>
 */
final class CreatorFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Creator::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'slug' => $this->faker->slug,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'description' => $this->faker->text,
            'birthday' => $this->faker->randomNumber(),
            'nickname' => $this->faker->word,
        ];
    }
}
