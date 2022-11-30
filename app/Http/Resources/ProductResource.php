<?php

namespace App\Http\Resources;

use App\Enums\ProductType;


class ProductResource extends MehraResource
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
            'sku'=> $this->sku,
            'related'=> $this->whenLoaded('related'),
            'upsell'=> $this->whenLoaded('upsell'),
            'cross_sell'=> $this->whenLoaded('cross_sell'),
            'parent'=> $this->whenLoaded('parent'),
            'volume'=> $this->whenLoaded('volume'),
            'volume_title'=> isset($this->order_volume) ? 'جلد '.$this->order_volume : null,
            'volumes'=> $this->whenLoaded('volumes',function (){
                foreach ($this->volumes as $key=> $volume){
                    if($volume->order_volume===$this->order_volume){
                        $this->volumes[$key]->is_active_volume = true;
                    }
                }
                return ProductResource::collection($this->volumes);
            }),
            'title'=> preg_replace( "/\r|\n/", "", $this->title ),
            'slug'=> $this->slug,
            'sub_title'=> $this->sub_title,
            'description'=> $this->description,
            'excerpt'=> $this->excerpt,
            'summary'=> $this->summary,
            'pdf'=> $this->pdf,
            'opinions'=> $this->opinions,
            'price'=> $this->price,
            'sale_price'=> $this->sale_price,
            'vat'=> $this->vat,
            'producer'=> $this->whenLoaded('producer'),
            'order'=> $this->order,
            'order_volume'=> $this->order_volume,
            'product_type'=> isset($this->product_type) ? ProductType::getDescription($this->product_type) : null,
            'min_purchases_per_user'=> $this->min_purchases_per_user,
            'max_purchases_per_user'=> $this->max_purchases_per_user,
            'is_available'=> $this->is_available,
            'in_stock_count'=> $this->in_stock_count,
            'is_active'=> $this->is_active,
            'rates'=> $this->whenLoaded('rates'),
            'rate'=> ['customers_count'=>10,'rate'=>4.33],
            'comments'=> $this->whenLoaded('comments',function () {
                return CommentResource::collection($this->comments->load(['points','likes']));
            }),
            'creators'=> $this->whenLoaded('creators'),
            'main_image'=> $this->whenLoaded('media',function (){
                if($this->hasMedia('main_image'))
                    return $this->getMedia('main_image')->first()->original_url;
            }),
            'gallery'=> $this->whenLoaded('media',function (){
                if($this->hasMedia('gallery'))
                    return $this->getMedia('gallery');
            }),
            'collections'=> $this->whenLoaded('collections'),
            'categories'=> $this->whenLoaded('categories'),
            'questions'=> $this->whenLoaded('questions'),
            'attributeValues'=> $this->whenLoaded('attributeValues'),
            'awards'=> $this->whenLoaded('awards'),
            'groups'=> $this->whenLoaded('groups',function (){
                return ProductGroupResource::collection($this->groups);
            })
        ];
    }
}
