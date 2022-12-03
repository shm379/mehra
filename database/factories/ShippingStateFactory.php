<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ShippingCity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ShippingState>
 */
final class ShippingStateFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = ShippingCity::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            '' => $this->faker->randomNumber(),
            'city' => $this->faker->randomElement(['TABRIZ', 'QOM', 'TEHRAN', 'OROMIEH', 'BIRJAND', 'BOJNORD', 'ISFAHAN', 'YAZD', 'MASHHAD', 'SHIRAZ', 'KARAJ', 'ARAK', 'ARDABIL', 'AHWAZ', 'ILAM', 'BANDARABAS', 'BUSHEHR', 'KHORAMABAD', 'RASHT', 'ZAHEDAN', 'ZANJAN', 'SARI', 'SEMNAN', 'SANANDAJ', 'SHAHREKURD', 'GHAZVIN', 'KERMAN', 'KERMANSHAH', 'GORGAN', 'HAMEDAN', 'YASUJ']),
        ];
    }
}
