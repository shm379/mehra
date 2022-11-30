<?php

namespace App\Http\Resources;



class CategoryResource extends MehraResource
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
            'slug'=> $this->slug,
            'description'=> $this->description,
            'path'=> $this->path,
            'category_template'=> $this->whenLoaded('category_template'),
            'is_active'=> $this->is_active,
        ];
    }
}
