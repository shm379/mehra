<?php

namespace App\Models;

use App\Enums\CommentPointStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Rank extends Pivot
{
    protected $table = 'ranks';
    protected $appends = [
        'comment',
        'rank',
        'number_of_voters',
        'product',
    ];

    public function attributes()
    {
        return $this->belongsToMany(RankAttribute::class,'ranks');
    }

    public function comments()
    {
        return $this->belongsToMany(Comment::class,'ranks');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'ranks');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'ranks');
    }

    public function getCommentAttribute()
    {
        $comment = Comment::query()->find($this->attributes['comment_id']);

        if (!$comment) return null;

        return $comment;
    }

    public function getNumberOfVotersAttribute()
    {
        $rank_attribute = RankAttribute::query()->find($this->attributes['rank_attribute_id']);
        if (!$rank_attribute) return null;
        return $rank_attribute->users->count();
    }

    public function getRankAttribute()
    {
        $rank = RankAttribute::query()->find($this->attributes['rank_attribute_id']);

        if (!$rank) return null;

        return round($rank->attributes()->avg('score'),2);
    }

    public function getProductAttribute()
    {
        $product = Product::query()->find($this->attributes['product_id']);

        if (!$product) return null;

        return $product;
    }
}
