<?php

namespace Database\Factories;

use App\Models\Award;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attribute>
 */
class AwardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "parent_id" => fake()->numberBetween(1, Award::count() - 1),
            'title' => fake('fa-IR')->text(),
            'slug' => fake()->slug(),
            'award_type' => fake()->randomElement([1, 2, 3, 4, 5]),
        ];
    }
}
