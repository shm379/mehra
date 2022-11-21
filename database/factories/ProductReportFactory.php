<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ProductReport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ProductReport>
 */
final class ProductReportFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = ProductReport::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'body' => $this->faker->text,
            'product_id' => $this->faker->randomNumber(),
        ];
    }
}
