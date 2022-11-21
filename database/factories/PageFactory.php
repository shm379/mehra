<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Page>
 */
final class PageFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Page::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'parent_id' => $this->faker->randomNumber(),
            'title' => $this->faker->title,
            'slug' => $this->faker->slug,
            'body' => $this->faker->text,
            'type' => $this->faker->randomNumber(),
            'admin_id' => $this->faker->randomElement(['1']),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
