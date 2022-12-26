<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Attribute;
use App\Models\Award;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Creator;
use App\Models\City;
use App\Models\CreatorType;
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
        $result = Category::query()->where('title', 'LIKE', '%' . $q . '%')->get();
        return $result;
    }
    public function attribute(Request $request)
    {
        return Attribute::all();
    }
    public function award($q, Request $request)
    {
        return Award::query()->where('title', 'LIKE', "%$q%")->get();
    }
    public function collections($q, Request $request)
    {
        return Collection::query()->where('title', 'LIKE', "%$q%")->get();
    }
    public function creatorTypes($q, Request $request)
    {
        return CreatorType::query()->where('name', 'LIKE', "%$q%")->get();
    }
    public function cities($q, Request $request)
    {
        return City::query()->where('title', 'LIKE', "%$q%")->get();
    }
}
