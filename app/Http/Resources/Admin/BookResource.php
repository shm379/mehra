<?php

namespace App\Http\Resources\Admin;

use App\Enums\ProductType;
use App\Enums\ProductRelatedType;
use App\Helpers\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends ProductResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return array_merge($this->getData(),[
            'volumes'=> $this->whenLoaded('volumes',function (){
                foreach ($this->volumes as $key=> $volume){
                    if($volume->order_volume===$this->order_volume){
                        $this->volumes[$key]->is_active_volume = true;
                    }
                }
                return BookVolumeResource::collection($this->volumes);
            }),
            //            'max_number'=> $this->max_purchases_per_user,
            'creators'=> $this->whenLoaded('creators',function (){
                $this->creators->load('medias');
                return BookCreatorResource::collection($this->creators);
            }),
            'is_liked'=> $this->is_liked,
            'related'=> $this->whenLoaded('productRelated',function (){
                return BookResource::collection($this->productRelated->where('type',ProductRelatedType::RELATED));
            }),
            'image'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('cover_image'))
                    return $this->getFirstMediaUrl('cover_image');
            }),
            'back_image'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('back_image'))
                    return $this->getFirstMediaUrl('back_image');
            }),
            'gallery'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('gallery'))
                    return BookGalleryResource::collection($this->getMedias('gallery'));
            }),
        ]);
    }
}
