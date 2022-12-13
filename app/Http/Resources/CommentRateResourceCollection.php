<?php

namespace App\Http\Resources;

use App\Helpers\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentRateResourceCollection extends MehraResourceCollection
{
    public function toArray($request)
    {
        $number_of_voters = $this->collection->unique('pivot.comment_id');
        $features = $this->collection->unique('pivot.rate_id');
        $score = $this->collection->avg('pivot.score');
        $count = $number_of_voters->count();
        return [
            "rank"=> round($score,2),
            "number_of_voters"=> $count,
            "features"=> $features->flatten()
        ];
    }
}
