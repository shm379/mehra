<?php

namespace App\Http\Resources\Api;

use App\Helpers\Helpers;

class UserCollectionResource extends MehraResource
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
            'image'=> $this->whenLoaded('model',function (){
                if($this->model->hasMedia('image'))
                    return $this->model->getFirstMediaUrl('image');
            }),
            'title'=> $this->model->title,
            'id'=> $this->model_id,
        ];
    }
}
