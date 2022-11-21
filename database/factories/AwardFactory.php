<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Award;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Award>
 */
final class AwardFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Award::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'parent_id' => \App\Models\Award::factory(),
            'title' => $this->faker->title,
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
            'award_type' => $this->faker->word,
            'is_active' => $this->faker->boolean,
            'admin_id' => $this->faker->randomNumber(),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
