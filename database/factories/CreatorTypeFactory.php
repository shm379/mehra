<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CreatorType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CreatorType>
 */
final class CreatorTypeFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = CreatorType::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'plural_name' => $this->faker->word,
        ];
    }
}
