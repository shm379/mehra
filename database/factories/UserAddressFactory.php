<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\UserAddress>
 */
final class UserAddressFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = UserAddress::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'national_number' => $this->faker->word,
            'province_id' => $this->faker->word,
            'state_id' => $this->faker->word,
            'number' => $this->faker->randomNumber(),
            'postal_code' => $this->faker->postcode,
            'district' => $this->faker->word,
            'unit' => $this->faker->word,
            'phone' => $this->faker->phoneNumber,
            'mobile' => $this->faker->word,
        ];
    }
}
