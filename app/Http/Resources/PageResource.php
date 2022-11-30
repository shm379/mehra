<?php

namespace App\Http\Resources;

use App\Enums\PageType;


class PageResource extends MehraResource
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
            'title'=> $this->title,
            'parent_id'=> $this->parent_id,
            'slug'=> $this->slug,
            'body'=> $this->body,
            'type'=> PageType::getDescription($this->type),
        ];
    }
}
