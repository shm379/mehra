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
        $home = Home::query()->get(['key','value','model'])->pluck('json')->flatMap(function ($v){
            return $v;
        });
        return new HomeResourceCollection($home->toArray());
    }
}
