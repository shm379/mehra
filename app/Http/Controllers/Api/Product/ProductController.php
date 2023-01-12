<?php

namespace App\Http\Controllers\Api\Product;

use App\Enums\AttributeType;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\ProductRankAttributeCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ProductController extends Controller {

    public function index(Request $request) : \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $products = Product::query()->with([
            'related',
            'parent',
            'groups',
            'volume',
            'volumes',
            'producer',
            'comments'=>function($comment){
                $comment->with(['medias','user','points','likes'])->where('status',1);
            },
            'creators'=>function($creator){
                $creator->with('types');
            },
            'collections',
            'awards',
            'groups',
            'categories',
            'questions',
            'attributeValues'=>function($value){
                $value->with('attribute');
            },
            'medias'
        ])->paginate($request->has('per_page') !== null ?$request->get('per_page'): 15);
        return ProductResource::collection($products);
    }
    public function show(Product $product): ProductResource
    {
        return ProductResource::make($product->load([
            'related',
            'upsell',
            'cross_sell',
            'groups',
            'parent',
            'volume',
            'volumes',
            'producer',
            'comments'=>function($comment){
                $comment->with(['medias','user','points','likes'])->where('status',1);
            },
            'creators'=>function($creator){
                $creator->with('types');
            },
            'collections',
            'awards',
            'groups',
            'categories',
            'questions',
            'attributeValues'=>function($value){
                $value->with('attribute');
            },
            'medias'
        ]));
    }

    public function getRanks(Product $product)
    {
        $features = $product->rank_attributes->unique('id');
        return new ProductRankAttributeCollection($features);
    }
}
