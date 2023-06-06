<?php

namespace App\Http\Controllers\Api\Product;

use App\Enums\AttributeType;
use App\Exceptions\MehraApiException;
use App\Http\Controllers\Api\Controller;
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

class CommentLikeController extends Controller {

    /*
     * Notification Service Inject
     */
    protected NotificationService $notificationService;
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Comment $comment)
    {
        try {
            $like = $comment->likes()->firstOrCreate(['user_id'=>auth()->id()]);
            if($like->exists){
                $this->notificationService->commentLike($comment,auth()->id());
            }
        } catch (\Exception $exception){
            return $exception->getMessage();
            return $this->errorResponse('خطا در انجام عملیات');
        }
        return $this->successResponse('عملیات با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Comment $comment)
    {
        try {
            $comment->likes()->delete(['user_id'=>$this->user_id]);

        } catch (MehraApiException $exception){
            return $this->errorResponse('خطا در انجام عملیات');
        }

        return $this->successResponse('عملیات با موفقیت انجام شد');

    }

}
