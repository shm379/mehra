<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Volume;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Volume>
 */
final class VolumeFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Volume::class;

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
            'description' => $this->faker->text,
            'is_active' => $this->faker->boolean,
            'admin_id' => $this->faker->randomElement(['1']),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
