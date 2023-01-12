<?php

namespace App\Http\Resources;

use App\Enums\ProductType;
use App\Enums\ProductRelatedType;
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
            'slug'=> $this->slug,
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
            'main_price'=> $this->price,
            'price'=> $this->sale_price ?: $this->price,
            'sale_percent'=> $this->sale_price==0 && !isset($this->sale_price) ? 0 : (1 - ($this->price / $this->sale_price)) * 100,
            'main_price_formatted'=> Helpers::toman($this->price),
            'price_formatted'=> $this->sale_price ? Helpers::toman($this->sale_price) : Helpers::toman($this->price),
            'currency'=> 'تومان',
            'max_number'=> $this->max_purchases_per_user,
            'creators'=> $this->whenLoaded('creators',function (){
                $this->creators->load('medias');
                return BookCreatorResource::collection($this->creators);
            }),
            'is_liked'=> $this->is_liked,
            'related'=> $this->whenLoaded('productRelated',function (){
                return BookResource::collection($this->productRelated->where('type',ProductRelatedType::RELATED));
            }),
            'cover_image'=> $this->whenLoaded('medias',function (){
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
        ];
    }
}
