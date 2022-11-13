<?php

namespace App\Http\Resources;

use App\Enums\CommentPointStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentPointResource extends JsonResource
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
            "comment_id"=> $this->comment_id,
            "title"=> $this->title,
            "status"=> $this->status==1?'مثبت':'منفی',
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at
        ];
    }
}
