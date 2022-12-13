<?php

namespace App\Http\Resources;

use App\Enums\CommentStatus;


class CommentRateResource extends MehraResource
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
            "title"=> $this->title,
            "rank"=> $this->pivot->rank,
            "number_of_voters"=> $this->pivot->number_of_voters,
        ];
    }
}
