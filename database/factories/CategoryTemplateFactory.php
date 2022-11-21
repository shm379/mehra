<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CategoryTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CategoryTemplate>
 */
final class CategoryTemplateFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = CategoryTemplate::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'schema' => $this->faker->text,
            'admin_id' => $this->faker->randomElement(['1']),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
