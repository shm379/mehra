<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CreatorAward;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CreatorAward>
 */
final class CreatorAwardFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = CreatorAward::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'creator_id' => $this->faker->randomNumber(),
            'award_id' => $this->faker->randomNumber(),
        ];
    }
}
