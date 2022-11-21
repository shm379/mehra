<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\AttributeValueProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\AttributeValueProduct>
 */
final class AttributeValueProductFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = AttributeValueProduct::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'attribute_value_id' => $this->faker->randomNumber(),
            'product_id' => $this->faker->randomNumber(),
        ];
    }
}
