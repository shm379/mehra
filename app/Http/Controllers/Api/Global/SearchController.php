<?php

namespace App\Http\Controllers\Api\Global;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Global\Search\SearchIndexRequest;
use App\Http\Resources\Api\Search\SearchCategoryResource;
use App\Http\Resources\Api\Search\SearchCreatorResource;
use App\Http\Resources\Api\Search\SearchProducerResource;
use App\Http\Resources\Api\Search\SearchProductResource;
use App\Models\Category;
use App\Models\Creator;
use App\Models\CreatorType;
use App\Models\Producer;
use App\Models\Product;
use App\Models\UserSearchHistory;

class SearchController extends Controller {

    public function histories()
    {
        if(!auth()->check()){
            return $this->errorResponse('شما وارد نشدید!');
        }
        $user_search_histories = UserSearchHistory::query();
        return [
            'search_histories' => $user_search_histories->where('user_id',auth()->id())->get(),
            'popular_searches'=> $user_search_histories->groupBy('title')->selectRaw('count(*) as count')->orderBy('count')->get()
        ];
    }

    public function index(SearchIndexRequest $request)
    {
        if($request->query->count()==0){
            return $this->histories();
        }
        // products
        $products = Product::query()->select(['id','title'])->with(['medias'])->where('title','LIKE',"%$request->q%")->get(['id','title']);
        $categories = Category::query()->select(['id','title'])->where('title','LIKE',"%$request->q%")->get();
        $producers = Producer::query()->select(['id','title'])->with(['medias'])->where('title','LIKE',"%$request->q%")->get();
        $creators = Creator::query()->select(['id','title'])->with(['types','medias'])->where('title','LIKE',"%$request->q%")->get();
        $creatorTypes = CreatorType::query()->get();
        $suggestions = [];
        if(auth()->check()){
            UserSearchHistory::query()->create(['title'=>$request->q,'user_id'=>auth()->id()]);
        }
        return [
            'products'=> SearchProductResource::collection($products),
            'categories' => SearchCategoryResource::collection($categories),
            'producers'=> SearchProducerResource::collection($producers),
            'authors' => SearchCreatorResource::collection($creators),
            'suggestions'=> $suggestions
        ];
    }
}
