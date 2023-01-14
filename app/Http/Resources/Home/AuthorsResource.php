<?php

namespace App\Http\Resources\Home;

class AuthorsResource extends HomeResource
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
            'image'=> $this->hasMedia('avatar') ? $this->getFirstMediaUrl('avatar') : null,
//            'items'=> ProductResource::collection($this->products()->get())
        ];
    }



    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'success' => true
        ];
    }
}
