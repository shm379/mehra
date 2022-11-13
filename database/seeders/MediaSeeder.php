<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\File;

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
        foreach ($products as $product){
            $media_rand = array_rand($media);
            $array = explode('.', $media[$media_rand]);
            if(end($array)=='mp4'){
                if(\Illuminate\Support\Facades\File::exists(public_path('media/').$media[$media_rand])){
                    $product->addMedia(public_path('media/').$media[$media_rand])->toMediaCollection('gallery');
                }
            }

//            if(\Illuminate\Support\Facades\File::exists(public_path('media_copy/').$media[$media_rand])){
//                for($i=0;$i<3;$i++){
//                    $media_rand = array_rand($media);
//                    $product->addMedia(public_path('media_copy/').$media[$media_rand])->toMediaCollection('gallery');
//                }
//            }
        }
    }
}
