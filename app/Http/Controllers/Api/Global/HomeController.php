<?php

namespace App\Http\Controllers\Api\Global;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\HomeResource;
use App\Http\Resources\HomeResourceCollection;
use App\Models\Award;
use App\Models\Category;
use App\Models\Home;
use App\Models\Product;

class HomeController extends Controller {

    public function index()
    {
        if(!cache()->has('home')){
            $home = Home::query()->get(['key','value','model','order'])->sortBy('order')->pluck('json')->flatMap(function ($v){
                return $v;
            });
            cache()->set('home',$home,5);
        }
        $home = cache()->get('home');
        return new HomeResourceCollection($home->toArray());
    }
}
