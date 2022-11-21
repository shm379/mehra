<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CreatorProductType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CreatorProductType>
 */
final class CreatorProductTypeFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = CreatorProductType::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'creator_id' => $this->faker->randomNumber(),
            'product_type' => $this->faker->randomNumber(),
        ];
    }
}
