<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\AttributeProductType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\AttributeProductType>
 */
final class AttributeProductTypeFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = AttributeProductType::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'attribute_id' => $this->faker->randomNumber(),
            'product_type' => $this->faker->randomNumber(),
        ];
    }
}
