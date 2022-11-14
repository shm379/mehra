<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Category;
use App\Models\Creator;
use App\Models\Producer;
use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    public function authors($q, Request $request)
    {
        return Creator::authors($q);
    }

    public function translators($q, Request $request)
    {
        return Creator::translators($q);
    }

    public function narrators($q, Request $request)
    {
        return Creator::narrators($q);
    }

    public function illustrators($q, Request $request)
    {
        return Creator::illustrators($q);
    }

    public function publishers($q, Request $request)
    {
        return Producer::publishers($q);
    }

    public function brands($q, Request $request)
    {
        return Producer::brands($q);
    }

    public function producers($q, Request $request)
    {
        return Producer::producers($q);
    }

    public function categories($q, Request $request)
    {
        $result = Category::where('title', 'LIKE', '%' . $q . '%')->get();
        return $result;
    }
}
