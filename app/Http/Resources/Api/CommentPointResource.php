<?php

namespace App\Http\Resources\Api;

use App\Enums\CommentPointStatus;


class CommentPointResource extends MehraResource
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
            "status"=> $this->status==1?'مثبت':'منفی',
        ];
    }
}
