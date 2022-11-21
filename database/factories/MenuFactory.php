<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Menu>
 */
final class MenuFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Menu::class;

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
            'url' => $this->faker->url,
            '_blank' => $this->faker->boolean,
            'is_visible' => $this->faker->boolean,
            'order' => $this->faker->randomNumber(),
            'css_class' => $this->faker->word,
            'position' => $this->faker->randomNumber(),
        ];
    }
}
