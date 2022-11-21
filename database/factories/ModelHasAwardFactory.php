<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ModelHasAward;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ModelHasAward>
 */
final class ModelHasAwardFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = ModelHasAward::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
        ];
    }
}
