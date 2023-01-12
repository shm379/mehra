<?php

namespace App\Http\Resources;

use App\Enums\CommentStatus;
use Illuminate\Http\Resources\Json\ResourceCollection;


class ProductCommentResource extends MehraResource
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
            "satisfied_no"=> $this->satisfied_no,
            "rate" => $this->whenLoaded('rank_attributes',function (){
                return new CommentRankResourceCollection($this->rank_attributes);
            }),
            "galleries"=> $this->whenLoaded('comments',function (){
                return new CommentGalleryResourceCollection($this->comments->pluck('medias')->flatten());
            }),
            "comments"=> $this->whenLoaded('comments',function (){
                return new CommentResourceCollection($this->comments);
            })
        ];
    }
}
