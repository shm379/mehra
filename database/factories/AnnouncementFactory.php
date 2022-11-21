<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Announcement>
 */
final class AnnouncementFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Announcement::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'url' => $this->faker->url,
            '_blank' => $this->faker->boolean,
            'is_active' => $this->faker->boolean,
            'position' => $this->faker->randomNumber(),
            'views' => $this->faker->randomNumber(),
            'admin_id' => $this->faker->randomElement(['1']),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
