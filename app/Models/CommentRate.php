<?php

namespace App\Models;

use App\Enums\CommentPointStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CommentRate extends Pivot
{
    protected $table = 'comment_rates';
    protected $appends = [
        'comment',
        'rank',
        'number_of_voters',
        'product',
    ];

    public function getCommentAttribute()
    {
        $comment = Comment::query()->find($this->attributes['comment_id']);

        if (!$comment) return null;

        return $comment;
    }

    public function getNumberOfVotersAttribute()
    {
        $rate = Rate::query()->find($this->attributes['rate_id']);

        if (!$rate) return null;
        return $rate->comments->count();
    }

    public function getRankAttribute()
    {
        $rate = Rate::query()->find($this->attributes['rate_id']);

        if (!$rate) return null;

        return round($rate->comments()->avg('score'),2);
    }

    public function getProductAttribute()
    {
        $product = Product::query()->find($this->attributes['product_id']);

        if (!$product) return null;

        return $product;
    }
}
