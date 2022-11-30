<?php

namespace App\Http\Resources;

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
            "user"=> $this->whenLoaded('user'),
            "user_id"=> $this->user_id,
            "order_id"=> $this->order_id,
            "body"=> $this->body,
            "product_id"=> $this->product_id,
            "parent_id"=> $this->parent_id,
            "rate"=> $this->rate,
            "status"=> CommentStatus::getDescription($this->status),
            "is_anonymous"=> $this->is_anonymous,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
            "admin_id"=> $this->admin_id,
            "deleted_at"=> $this->deleted_at,
            "media"=> $this->whenLoaded('media'),
            "points"=> $this->whenLoaded('points',function (){
                return CommentPointResource::collection($this->points);
            }),
            "likes_count"=> $this->whenLoaded('likes',function (){
                return $this->likes->where('is_dislike',0)->count();
            }),
            "dislikes_count"=> $this->whenLoaded('likes',function (){
                return $this->likes->where('is_dislike',1)->count();
            })
        ];
    }
}
