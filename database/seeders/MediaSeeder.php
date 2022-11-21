<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\File;
use Faker\Factory as Faker;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $media = Storage::disk('media')->allFiles();
        $products = Product::query()->get();

        $faker = Faker::create();

        foreach ($products as $product) {
            $imageUrl = $faker->imageUrl(640, 480, null, false);
            $product->addMediaFromUrl($imageUrl)->toMediaCollection('gallery');
        }
    }
}
