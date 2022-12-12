<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ShippingCity>
 */
final class ShippingCityFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = City::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'shipping_id' => $this->faker->randomNumber(),
            'city' => $this->faker->randomElement(['TABRIZ', 'QOM', 'TEHRAN', 'OROMIEH', 'BIRJAND', 'BOJNORD', 'ISFAHAN', 'YAZD', 'MASHHAD', 'SHIRAZ', 'KARAJ', 'ARAK', 'ARDABIL', 'AHWAZ', 'ILAM', 'BANDARABAS', 'BUSHEHR', 'KHORAMABAD', 'RASHT', 'ZAHEDAN', 'ZANJAN', 'SARI', 'SEMNAN', 'SANANDAJ', 'SHAHREKURD', 'GHAZVIN', 'KERMAN', 'KERMANSHAH', 'GORGAN', 'HAMEDAN', 'YASUJ']),
        ];
    }
}
