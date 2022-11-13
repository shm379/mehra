<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\CategoryTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{

    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'parent_id'=> rand(1,2)%2==0 && Category::query()->where('id',1)->exists() ?Category::query()->latest()->first()->id:null,
            'title'=> $this->faker->jobTitle,
            'slug' => $this->faker->slug,
            'path' => $this->faker->slug.'/',
            'description' => $this->faker->realText,
            'category_template_id'=> CategoryTemplate::query()->get()->toArray()[array_rand(CategoryTemplate::query()->get()->toArray())]['id'],
            'is_active'=>1
        ];
    }
}
