<?php

namespace App\Http\Controllers\Api\Product;

use App\Enums\AttributeType;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Product\StoreCommentRequest;
use App\Http\Resources\CommentResourceCollection;
use App\Http\Resources\ProductCommentResource;
use App\Http\Resources\ProductCommentResourceCollection;
use App\Http\Resources\ProductResource;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CommentController extends Controller {

    public function index(Request $request, Product $product)
    {
        $product = $product->load(['rank_attributes','comments'=> function($c){
                    $c->with(['points','likes','media']);
                }
            ]);
        return ProductCommentResource::make($product);
    }

    public function store(StoreCommentRequest $request, Product $product)
    {
        try {

            $comment = auth()->user()->comments()->create($request->validated());
            $this->saveCommentPoints($comment,$request);
            $this->saveRanks($comment,$request);
            $this->uploadMedia($comment,'gallery','media',false);
        } catch (\Exception $exception){
            dd($exception->getMessage());
            return $this->errorResponse('خطا در انجام عملیات');
        }
        return $this->successResponse('عملیات با موفقیت انجام شد');
    }

    private function  saveCommentPoints($comment,$request)
    {
        if ($request->has('advantages'))
            foreach ($request->validated(['advantages']) as $advantages)
                $comment->advantages()->create($advantages);
        if ($request->has('disadvantages'))
            foreach ($request->validated(['disadvantages']) as $disadvantages)
                $comment->disadvantages()->create($disadvantages);
    }

    private function  saveRanks($comment,$request)
    {
        if($request->has('features')) {
            foreach ($request->validated(['features']) as $feature) {
                if($comment->ranks()
                    ->where('user_id',$comment->user_id)
                    ->where('product_id',$comment->product_id)
                    ->where('rank_attribute_id',$feature['rank_attribute_id'])
                    ->doesntExist()
                )
                    $comment->ranks()->create(array_merge($feature, [
                        'user_id' => $comment->user_id,
                        'product_id' => $comment->product_id,
                    ]));
            }
        }
    }
}
