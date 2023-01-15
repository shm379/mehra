<?php

namespace App\Http\Resources\Api;

use App\Enums\CommentStatus;


class CommentGalleryResource extends MehraResource
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
            "url"=> $this->original_url,
            "type"=> $this->mime_type,
            "user"=> $this->whenLoaded('model', function (){
                return UserResource::make($this->model->user_id);
            }),
            "comment"=> $this->whenLoaded('model', function (){
                return CommentResource::make($this->model);
            }),
        ];
    }
}
