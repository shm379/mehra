<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slider = Slider::factory(2)->create();
        dd($slider);
        $settings = collect([
            [
                'key'=> 'slider',
                'value'=> null,
                'parent_id'=> null,
                'children'=> [

                ]
            ],
            [
                'key'=> 'sale',
                'value'=> null,
                'parent_id'=> null,
                'children'=> [
                    [

                    ],
                ]
            ],
            [
                'key'=> 'categories',
                'value'=> null,
                'parent_id'=> null,
                'children'=> [
                    [
                        'key'=> 'model_id',
                        'value'=> null,
                        'children'=> [
                            [
                                'key'=> 'item_id',
                                'value'=> null,
                            ],
                        ]
                    ],
                    [
                        'key'=> 'model_id',
                        'value'=> null,
                    ],
                ]
            ],
        ]);
        foreach ($settings as $key => $setting){
            $children = $setting->children;
            unset($setting->children);
            $parentSetting = \App\Models\Setting::query()->create($setting);
            if($parentSetting->wasRecentlyCreated){
                foreach ($children as $child) {
                    $child['parent_id'] = $parentSetting->id;
                    \App\Models\Setting::query()->create($child);
                }
            }
        }
    }
}
