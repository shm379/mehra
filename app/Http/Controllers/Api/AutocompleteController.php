<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Category;
use App\Models\Creator;
use App\Models\Producer;
use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    public function publisher($q, Request $request)
    {
        $result = Producer::where('title', 'LIKE', '%' . $q . '%')->get();
        return $result;
    }
    public function creator($q, Request $request)
    {
        $result = Creator::where('title', 'LIKE', '%' . $q . '%')->get();
        return $result;
    }
    public function category($q, Request $request)
    {
        $result = Category::where('title', 'LIKE', '%' . $q . '%')->get();
        return $result;
    }
}
