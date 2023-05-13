<?php

namespace App\Http\Controllers\Api\Product;

use App\Enums\AttributeType;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\api\product\ReplyCommentRequest;
use App\Http\Requests\Api\Product\StoreCommentRequest;
use App\Http\Resources\Api\CommentResourceCollection;
use App\Http\Resources\Api\ProductCommentResource;
use App\Http\Resources\Api\ProductCommentResourceCollection;
use App\Http\Resources\Api\ProductResource;
use App\Models\Comment;
use App\Models\Product;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CommentController extends Controller {
    /*
     * Notification Service Inject
     */
    protected NotificationService $notificationService;
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    public function index(Request $request, Product $product)
    {
        return ProductCommentResource::make($product);
    }

    public function store(StoreCommentRequest $request, Product $product)
    {
        try {
            $comment = auth()->user()->comments()->create($request->validated());
            $this->saveCommentPoints($comment,$request);
            $this->saveRanks($comment,$request);
            $this->uploadMedia($comment);
        } catch (\Exception $exception){
            return $this->errorResponse('خطا در انجام عملیات');
        }
        return $this->successResponse('عملیات با موفقیت انجام شد');
    }

    /**
     * Reply To Comment
     *
     * @param StoreCommentRequest $request
     * @param Product $product
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function reply(ReplyCommentRequest $request, Product $product, Comment $comment)
    {
        try {
            $commentData = $request->validated();
            $commentData['parent_id'] = $comment->id; // یا هر شیوه‌ی دیگری که مقدار parent_id را برابر با شناسه‌ی نظری که به آن پاسخ داده می‌شود قرار دهد.
            auth()->user()->comments()->create($commentData);
            $this->notificationService->commentReply($comment,auth()->id());
        } catch (\Exception $exception){
            return $this->errorResponse('خطا در انجام عملیات');
        }
        return $this->successResponse('عملیات با موفقیت انجام شد');
    }

    private function saveCommentPoints($comment,$request)
    {
        if ($request->has('advantages'))
            foreach ($request->validated(['advantages']) as $advantages)
                $comment->advantages()->create($advantages);
        if ($request->has('disadvantages'))
            foreach ($request->validated(['disadvantages']) as $disadvantages)
                $comment->disadvantages()->create($disadvantages);
    }

    private function saveRanks($comment,$request)
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
