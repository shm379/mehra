<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Category>
 */
final class CategoryFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Category::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'parent_id' => \App\Models\Category::factory(),
            'title' => $this->faker->title,
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
            'path' => $this->faker->word,
            'category_template_id' => \App\Models\CategoryTemplate::factory(),
            'is_active' => $this->faker->boolean,
            'admin_id' => $this->faker->randomElement(['1']),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
