<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductProductGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productGroups = ProductGroup::query()->pluck('id')->toArray();
        foreach (Product::query()->get() as $product) {
            $product->groups()->attach($productGroups[array_rand($productGroups,1)]);
        }
    }
}
