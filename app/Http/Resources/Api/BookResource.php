<?php

namespace App\Http\Resources\Api;

use App\Enums\ProductType;
use App\Enums\ProductRelatedType;
use App\Helpers\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\API\FeaturedProductResource;


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
        $routeUrl = explode('.', request()->route()->getName());
        $book = [];
        if (end($routeUrl) == 'show') {
            $book = [
                'comments' => $this->whenLoaded('comments', function () {
                    return new CommentResourceCollection($this->comments);
                }),
                'galleries' => $this->whenLoaded('comments', function () {
                    $media = $this->comments->pluck('medias');
                    return new CommentGalleryResourceCollection($media->flatten());
                }),
                "satisfied_no" => $this->satisfied_no,
                "rate" => $this->whenLoaded('rank_attributes', function () {
                    return new CommentRankResourceCollection($this->rank_attributes);
                }),
                'related'=> $this->whenLoaded('productRelated',function (){
                    return new ProductRelatedResourceCollection($this->productRelated->where('type',ProductRelatedType::RELATED));
                },[]),
                'upsell'=> $this->whenLoaded('productRelated',function (){
                    return new ProductRelatedResourceCollection($this->productRelated->where('type',ProductRelatedType::UPSELL));
                },[]),
                'cross_sell'=> $this->whenLoaded('productRelated',function (){
                    return new ProductRelatedResourceCollection($this->productRelated->where('type',ProductRelatedType::CROSS_SELL));
                },[]),
            ];
        }

        return array_merge([
            'id'=> $this->id,
            'slug'=> $this->slug,
            'title'=> $this->title,
            'sub_title'=> $this->sub_title,
            'attributes'=> $this->whenLoaded('attributeValues',function (){
                return new BookAttributeResourceCollection($this->attributeValues);
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
            'sale_percent'=> $this->sale_percent,
            'main_price_formatted'=> Helpers::toman($this->price),
            'price_formatted'=> $this->sale_price ? Helpers::toman($this->sale_price) : Helpers::toman($this->price),
            'currency'=> 'تومان',
            'max_number'=> $this->max_purchases_per_user,
            'creators'=> $this->whenLoaded('creators',function (){
                return BookCreatorResource::collection($this->creators);
            }),
            'is_liked'=> $this->is_liked,
            'image'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('image'))
                    return $this->getFirstMediaUrl('image');
            }),
            'back_image'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('back_image'))
                    return $this->getFirstMediaUrl('back_image');
            }),
            'gallery'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('gallery'))
                    return BookGalleryResource::collection($this->getMedias('gallery'));
            }),
            'featured' => $this->is_featured ?[
                'is_featured'=>$this->is_featured,
                'start_date'=>$this->sale_date_start,
                'end_date'=>$this->sale_date_end
            ]: 'null',
        ],$book);
    }
}
