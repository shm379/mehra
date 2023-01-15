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
        $products = Product::query()->select(['id','title'])->where('title','LIKE',"%$request->q%")->get(['id','title']);
        $categories = Category::query()->select(['id','title'])->where('title','LIKE',"%$request->q%")->get();
        $producers = Producer::query()->select(['id','title'])->where('title','LIKE',"%$request->q%")->get();
        $creators = Creator::query()->select(['id','title'])->where('title','LIKE',"%$request->q%")->get();
        $suggestions = [];
        return [
            'products'=>$products->map(function ($q){
                return [$q->id=>$q->title];
            }),
            'categories' => $categories,
            'producers'=> $producers,
            'creators' => $creators,
            'suggestions'=> $suggestions
        ];
    }
}
