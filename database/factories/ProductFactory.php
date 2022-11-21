<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Product>
 */
final class ProductFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Product::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'sku' => $this->faker->word,
            'parent_id' => \App\Models\Product::factory(),
            'volume_id' => \App\Models\Volume::factory(),
            'title' => $this->faker->title,
            'slug' => $this->faker->slug,
            'sub_title' => $this->faker->word,
            'description' => $this->faker->text,
            'excerpt' => $this->faker->text,
            'summary' => $this->faker->text,
            'price' => $this->faker->randomFloat(),
            'sale_price' => $this->faker->randomFloat(),
            'vat' => $this->faker->randomFloat(),
            'producer_id' => \App\Models\Producer::factory(),
            'product_type' => $this->faker->randomNumber(),
            'product_structure' => $this->faker->randomNumber(),
            'order_volume' => $this->faker->randomNumber(),
            'order' => $this->faker->randomNumber(),
            'min_purchases_per_user' => $this->faker->randomNumber(),
            'max_purchases_per_user' => $this->faker->randomNumber(),
            'is_virtual' => $this->faker->boolean,
            'is_available' => $this->faker->boolean,
            'in_stock_count' => $this->faker->randomNumber(),
            'is_active' => $this->faker->boolean,
            'admin_id' => $this->faker->randomElement(['1']),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
