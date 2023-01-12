<?php

namespace App\Http\Resources;



class CreatorResource extends MehraResource
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
            'first_name'=> $this->first_name,
            'last_name'=> $this->last_name,
            'name'=> $this->name,
            'description'=> $this->description,
            'birthday'=> $this->birthday,
            'nickname'=> $this->nickname,
            'avatar'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('avatar'))
                    return $this->getFirstMediaUrl('avatar');
            }),
            'books'=> $this->whenLoaded('books', function (){
                return BookResource::collection($this->books);
            }),
            'awards'=> $this->whenLoaded('awards', function (){
                return AwardResource::collection($this->awards);
            }),
        ];
    }
}
