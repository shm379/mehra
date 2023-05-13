<?php

namespace App\Services;

use App\Enums\NotificationActivityType;
use App\Enums\OrderStatus;
use App\Enums\ProductStructure;
use App\Models\Book;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Discount;
use App\Models\User;
use Illuminate\Support\Facades\App;

class NotificationService
{
    public function commentLike($comment,$actor_id)
    {
        $user = User::query()->find($comment->user_id);
        $actor = User::query()->find($actor_id);
        $user->messages()->create([
            'notifier_id'=> $comment->user_id,
            'actor_id'=> $actor_id,
            'object_id'=> $comment->id,
            'object_type'=> 'comment',
            'activity_type'=> NotificationActivityType::COMMENT_LIKE,
            'sent_at'=>now(),
            'body'=> $actor->name.' کامنت شما را لایک کرد'
        ]);
    }
    public function commentReply($comment, $actor_id)
    {
        $user = User::query()->find($comment->user_id);
        $actor = User::query()->find($actor_id);
        $body = $actor->name . ' روی کامنت شما پاسخ داد: "' . $comment->body . '"';
        $user->messages()->create([
            'notifier_id' => $comment->user_id,
            'actor_id' => $actor_id,
            'object_id' => $comment->id,
            'object_type' => 'comment',
            'activity_type' => NotificationActivityType::COMMENT_REPLY,
            'sent_at' => now(),
            'body' => $body
        ]);
    }
}
