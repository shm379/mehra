<?php

namespace App\Http\Controllers\Api\Product;

use App\Enums\AttributeType;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CommentController extends Controller {

    public function index(Request $request) : \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $comments = Comment::query()->with(['product'])->paginate($request->has('per_page') !== null ?$request->get('per_page'): 15);
        return ProductResource::collection($comments);
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
                $comment->with(['media','user','points','likes'])->where('status',1);
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
            'media'
        ]));
    }
}
