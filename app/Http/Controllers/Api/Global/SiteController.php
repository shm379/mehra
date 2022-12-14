<?php

namespace App\Http\Controllers\Api\Global;

use App\Http\Controllers\Api\Controller;
use App\Models\Announcement;
use App\Models\Award;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;

class SiteController extends Controller {

    public function index()
    {
        return $this->successResponseWithData([
            'menu'=> Menu::query()->get(),
            'announcements'=> Announcement::query()->first(),
        ]);
    }
}
