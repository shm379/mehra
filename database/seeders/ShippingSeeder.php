<?php

namespace Database\Seeders;

use App\Enums\ShippingType;
use App\Models\City;
use App\Models\Shipping;
use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shipping::query()->create([
            'title'=> 'ارسال با پست',
            'type'=> ShippingType::TAPIN,
            'is_active'=>1,
            'all_products'=>1,
            'all_cities'=>1
        ]);
    }
}
