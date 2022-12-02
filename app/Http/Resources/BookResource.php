<?php

namespace App\Http\Resources;

use App\Enums\ProductType;
use App\Helpers\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends MehraResource
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
            'title'=> preg_replace( "/\r|\n/", "", $this->title ),
            'sub_title'=> $this->sub_title,
            'attributes'=> $this->whenLoaded('attributeValues',function (){
                return BookAttributeResource::collection($this->attributeValues);
            }),
            'volumes'=> $this->whenLoaded('volumes',function (){
                foreach ($this->volumes as $key=> $volume){
                    if($volume->order_volume===$this->order_volume){
                        $this->volumes[$key]->is_active_volume = true;
                    }
                }
                return BookVolumeResource::collection($this->volumes);
            }),
            'description'=> $this->description,
            'main_price'=> Helpers::toman($this->price),
            'price'=> $this->sale_price ? Helpers::toman($this->sale_price) : Helpers::toman($this->price),
            'max_number'=> $this->max_purchases_per_user,
            'creators'=> $this->whenLoaded('creators',function (){
                $this->creators->load('media');
                return BookCreatorResource::collection($this->creators);
            }),
            'cover_image'=> $this->whenLoaded('media',function (){
                if($this->hasMedia('cover_image'))
                    return $this->getMedia('cover_image')->first()->original_url;
            }),
            'back_image'=> $this->whenLoaded('media',function (){
                if($this->hasMedia('back_image'))
                    return $this->getMedia('back_image')->first()->original_url;
            }),
            'gallery'=> $this->whenLoaded('media',function (){
                if($this->hasMedia('gallery'))
                    return BookGalleryResource::collection($this->getMedia('gallery'));
            }),
        ];
    }
}
