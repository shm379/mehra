<?php

namespace Database\Factories;

use App\Enums\ProducerType;
use App\Models\Producer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producer>
 */
class ProducerFactory extends Factory
{

    protected $model = Producer::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->jobTitle,
            'sub_title'=>$this->faker->jobTitle,
            'slug'=>$this->faker->unique()->slug,
            'description'=>$this->faker->text(10),
            'producer_type'=>ProducerType::getRandomValue(),
            'is_active'=>1
        ];
    }
}
