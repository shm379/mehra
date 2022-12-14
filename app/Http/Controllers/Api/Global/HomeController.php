<?php

namespace App\Http\Controllers\Api\Global;

use App\Http\Controllers\Api\Controller;
use App\Models\Award;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller {

    public function index()
    {
        return $this->successResponseWithData([
            'products'=>Product::query()->get(),
            'categories'=>Category::query()->get(),
            'awards'=>Award::query()->get()
        ]);
    }
}
