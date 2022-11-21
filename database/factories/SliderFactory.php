<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Slider>
 */
final class SliderFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Slider::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'link' => $this->faker->url,
            'is_active' => $this->faker->boolean,
            'color' => $this->faker->word,
            'admin_id' => $this->faker->randomElement(['1']),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
