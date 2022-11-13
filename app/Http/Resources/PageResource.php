<?php

namespace App\Http\Resources;

use App\Enums\PageType;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
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
