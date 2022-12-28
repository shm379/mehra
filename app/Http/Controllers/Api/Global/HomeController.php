<?php

namespace App\Http\Controllers\Api\Global;

use App\Http\Controllers\Api\Controller;
use App\Models\Award;
use App\Models\Category;
use App\Models\Home;
use App\Models\Product;

class HomeController extends Controller {

    public function index()
    {
        $home = Home::query()->get();
        return $home->first()->json;
        return $this->successResponseWithData($home->pluck('data')->toArray());
    }
}
