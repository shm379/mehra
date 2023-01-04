<?php

namespace App\Http\Controllers\Api\Global;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Global\Search\SearchIndexRequest;
use App\Models\Category;
use App\Models\Creator;
use App\Models\Producer;
use App\Models\Product;
use App\Models\UserSearchHistory;

class SearchController extends Controller {

    public function histories()
    {
        return [
            'search_histories' => auth()->user()->histories(),
            'popular_searches'=> UserSearchHistory::query()->groupBy('title')->selectRaw('count(*) as count')->orderBy('count')
        ];
    }

    public function index(SearchIndexRequest $request)
    {
        if($request->query->count()==0){
            return $this->histories();
        }
        // products
        $products = Product::query()->select(['title'])->where('title',"%$request->q%")->get();
        $categories = Category::query()->select(['title'])->where('title',"%$request->q%")->get();
        $producers = Producer::query()->select(['title'])->where('title',"%$request->q%")->get();
        $creators = Creator::query()->select(['title'])->where('title',"%$request->q%")->get();
        $suggestions = [];
        return [
            'products'=>$products,
            'categories' => $categories,
            'producers'=> $producers,
            'creators' => $creators,
            'suggestions'=> $suggestions
        ];
    }
}
