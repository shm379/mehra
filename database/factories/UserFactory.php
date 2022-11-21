<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\User>
 */
final class UserFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = User::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'country_id' => $this->faker->randomNumber(),
            'national_number' => $this->faker->word,
            'email' => $this->faker->safeEmail,
            'email_verified_at' => $this->faker->dateTime(),
            'mobile' => $this->faker->word,
            'mobile_verified_at' => $this->faker->dateTime(),
            'password' => bcrypt($this->faker->password),
            'remember_token' => Str::random(10),
            'type' => $this->faker->randomElement(['1', '2']),
            'gender' => $this->faker->randomElement(['1', '2']),
            'city' => $this->faker->randomElement(['TABRIZ', 'QOM', 'TEHRAN', 'OROMIEH', 'BIRJAND', 'BOJNORD', 'ISFAHAN', 'YAZD', 'MASHHAD', 'SHIRAZ', 'KARAJ', 'ARAK', 'ARDABIL', 'AHWAZ', 'ILAM', 'BANDARABAS', 'BUSHEHR', 'KHORAMABAD', 'RASHT', 'ZAHEDAN', 'ZANJAN', 'SARI', 'SEMNAN', 'SANANDAJ', 'SHAHREKURD', 'GHAZVIN', 'KERMAN', 'KERMANSHAH', 'GORGAN', 'HAMEDAN', 'YASUJ']),
            'admin_id' => $this->faker->randomElement(['1']),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
