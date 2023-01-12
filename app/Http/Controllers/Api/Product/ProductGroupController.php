<?php
namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\ProductGroupResource;
use App\Http\Resources\ProductResource;
use App\Models\ProductGroup;
use Illuminate\Http\Request;

class ProductGroupController extends Controller {

    public function index(Request $request) : \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $productGroups = ProductGroup::query()->with([
            'products'=>function($product){
                $product->with([
                    'parent',
                    'volume',
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
                    'attributes'=>function($attribute){
                            $attribute->with('values');
                        },
                    'medias'
                    ]);
            },

        ])->paginate($request->has('per_page') !== null ?$request->get('per_page'): 15);
        return ProductGroupResource::collection($productGroups);
    }
    public function show(ProductGroup $productGroup): ProductGroupResource
    {
        dd($productGroup->load([
            'products'=>function($product){
                $product->with([
                    'related',
                    'parent',
                    'volume',
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
                    'attributes'=>function($attribute){
                        $attribute->with('values');
                    },
                    'medias'
                ]);
            }
        ]));
//        return ProductGroup::make();
    }
}
