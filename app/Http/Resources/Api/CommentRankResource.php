<?php

namespace App\Http\Resources\Api;

use App\Enums\CommentStatus;


class CommentRankResource extends MehraResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"=> $this->id,
            "title"=> $this->title,
            "rank"=> $this->pivot->rank,
            "number_of_voters"=> $this->pivot->number_of_voters,
        ];
    }
}
