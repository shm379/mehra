<?php

namespace App\Http\Resources\Api;


use App\Models\Category;

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
            'id'=> $this->id,
            'title'=> $this->title,
            'collections'=> $this->whenLoaded('collections',function (){
                return new CollectionCategoryProductResourceCollection($this->collections);
            }),
            'children'=> $this->whenLoaded('children',function (){
                return new CategoryResourceCollection($this->children->load('medias'));
            }),
            'parent'=> $this->whenLoaded('parent',function (){
                return new CategoryResource($this->parent->load('medias'));
            }),
            'slug'=> $this->slug,
            'description'=> $this->description,
            'category_template'=> $this->whenLoaded('category_template'),
            'image'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('image'))
                    return $this->getFirstMediaUrl('image');
            }),
        ];
    }
}
