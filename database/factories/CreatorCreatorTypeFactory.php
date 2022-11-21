<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CreatorCreatorType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CreatorCreatorType>
 */
final class CreatorCreatorTypeFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = CreatorCreatorType::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'creator_id' => $this->faker->randomNumber(),
            'creator_type_id' => $this->faker->randomNumber(),
        ];
    }
}
