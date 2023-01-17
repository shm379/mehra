<?php

namespace App\Http\Resources\Api;

use App\Enums\CommentPointStatus;
use App\Enums\CommentStatus;


class CommentResource extends MehraResource
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
            "name"=> $this->is_anonymous ? 'ناشناس' : $this->user->name,
            "avatar"=> $this->is_anonymous || !$this->user->hasMedia('avatar') ? $this->getDefaultAvatar() : $this->user->getFirstMediaUrl('avatar'),
            "rate"=> $this->whenLoaded('rank_attributes',function (){
                return new CommentRankResourceCollection($this->rank_attributes);
            }),
            "i_suggest"=> (bool)$this->i_suggest,
            "body"=> $this->body,
            "is_buyer"=> (bool)$this->is_buyer,
            "date"=> optional($this->created_at)->diffForHumans(),
            "clap"=> $this->whenLoaded('likes',function (){
                return $this->likes->where('is_dislike',0)->count();
            }),
            "advantages"=> $this->whenLoaded('points',function (){
                return CommentPointResource::collection($this->points->where('status',CommentPointStatus::POSITIVE));
            }),
            "disadvantages"=> $this->whenLoaded('points',function (){
                return CommentPointResource::collection($this->points->where('status',CommentPointStatus::NEGATIVE));
            }),
            'media'=> $this->whenLoaded('medias',function (){
                return new CommentGalleryResourceCollection($this->medias);
            }),
        ];
    }
}
