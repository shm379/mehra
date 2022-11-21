<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Collection>
 */
final class CollectionFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Collection::class;

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
            'description' => $this->faker->text,
            'type' => $this->faker->randomNumber(),
            'is_private' => $this->faker->boolean,
            'user_id' => $this->faker->randomNumber(),
            'admin_id' => $this->faker->randomElement(['1']),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
