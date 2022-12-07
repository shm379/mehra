<?php

namespace App\Http\Resources;



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
//            'books'=> $this->whenLoaded('books',function (){
//                return new BookResourceCollection($this->books);
//            }),
            'children'=> $this->whenLoaded('children',function (){
                return new CategoryResourceCollection($this->children->load('media'));
            }),
            'parent'=> $this->whenLoaded('parent',function (){
                return new CategoryResource($this->parent->load('media'));
            }),
            'slug'=> $this->slug,
            'description'=> $this->description,
            'category_template'=> $this->whenLoaded('category_template'),
            'image'=> $this->whenLoaded('media',function (){
                if($this->hasMedia('image'))
                    return $this->getMedia('image')->first()->original_url;
            }),
        ];
    }
}
