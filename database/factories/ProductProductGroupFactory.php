<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ProductProductGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ProductProductGroup>
 */
final class ProductProductGroupFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = ProductProductGroup::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->randomNumber(),
            'product_group_id' => $this->faker->randomNumber(),
        ];
    }
}
