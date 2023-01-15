<?php

namespace App\Http\Resources\Api;

use App\Helpers\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentRankResourceCollection extends MehraResourceCollection
{
    public function toArray($request)
    {
        $number_of_voters = $this->collection->unique('pivot.user_id');
        $features = $this->collection->unique('pivot.rank_attribute_id');
        $score = $this->collection->avg('pivot.score');
        $count = $number_of_voters->count();
        return [
            "rank"=> round($score,2),
            "number_of_voters"=> $count,
            "features"=> $features->flatten()
        ];
    }
}
