<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\OrderNote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\OrderNote>
 */
final class OrderNoteFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = OrderNote::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'order_id' => $this->faker->randomNumber(),
            'note' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['SUCCESS', 'FAILURE']),
            'type' => $this->faker->randomElement(['1', '2']),
            'admin_id' => $this->faker->randomElement(['1']),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
