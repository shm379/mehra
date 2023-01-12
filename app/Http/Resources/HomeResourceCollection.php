<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\Slider;

class HomeResourceCollection extends MehraResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if (is_null($this->resource)) {
            return [];
        }
//        foreach ($this->resource as $model=> $item){
//            $modelName = config('morphmap')[$model];
//            switch ($modelName){
////                case Slider::class:
////                    $this->collection[$model] = SliderResource::collection($item->resource);
////                    break;
////                case Product::class:
////                    $this->collection[$model] = SliderResource::collection($item->resource);
////                    break;
////                case Slider::class:
////                    $this->collection[$model] = SliderResource::collection($item->resource);
////                    break;
////                case Slider::class:
////                    $this->collection[$model] = SliderResource::collection($item->resource);
////                    break;
////                case Slider::class:
////                    $this->collection[$model] = SliderResource::collection($item->resource);
////                    break;
//            }
//
//        }
        return $this->collection->map->toArray($request)->all();
    }
}
