<?php

namespace Database\Seeders;

use App\Enums\SettingSection;
use App\Models\Category;
use App\Models\Home;
use App\Models\Product;
use App\Models\Setting;
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
        $homeSettings = Home::query()->get();
        if($homeSettings->count()<=0){
            $settings = [
                [
                    'key'=>'sliders',
                    'model'=> config('morphmap.slider')
                ],
                [
                    'key'=>'sale',
                    'model'=> config('morphmap.product')
                ],
                [
                    'key'=>'categories[0]',
                    'model'=> config('morphmap.category')
                ],
                [
                    'key'=>'categories[1]',
                    'model'=> config('morphmap.collection')
                ],
                [
                    'key'=>'lists',
                    'model'=> config('morphmap.collection')
                ],
                [
                    'key'=>'banners',
                    'model'=> config('morphmap.announcement')
                ],
                [
                    'key'=>'news',
                ],
            ];
            foreach ($settings as $key => $setting) {
                $setting['section'] = SettingSection::HOME;
                Home::query()->create($setting);
            }
            $homeSettings = Home::query()->get();

        }
        if($homeSettings->count()>0){
            $limit = 1;
            foreach ($homeSettings as $key => $setting) {
                switch ($setting->key) {
                    case 'banners':
                    case 'sale':
                        $limit = 10;
                        break;
                    case 'categories[0]':
                    case 'categories[1]':
                    case 'collections':
                    case 'sliders':
                        $limit = 2;
                        break;
                }
                $model = (new $setting->model)->get()->take($limit);
                $value =  $model->pluck('id')->toArray();

                $setting->update([
                    'value'=> $value
                ]);
            }
        }
    }
}
