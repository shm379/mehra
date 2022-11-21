<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Producer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Producer>
 */
final class ProducerFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Producer::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'sub_title' => $this->faker->word,
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
            'site_url' => $this->faker->word,
            'producer_type' => $this->faker->randomNumber(),
            'is_active' => $this->faker->boolean,
            'admin_id' => $this->faker->randomElement(['1']),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
