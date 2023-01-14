<?php

namespace App\Models;

use App\Enums\SettingSection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Setting
{
    protected $table = 'settings';
    protected $appends = ['json'];
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    public function newQuery($excludeDeleted = true): \Illuminate\Database\Eloquent\Builder
    {
        return parent::newQuery()->whereSection(SettingSection::HOME);
    }
    public function model()
    {
        $this->morphTo();
    }

    /*
     * Convert Key TO Value With Model
     */
    private function convertKeyToValue($key,$model){
        $values = null;
        $resources = null;
        switch ($key) {
            case 'sliders':
                $resources[$key] = \App\Http\Resources\Home\SliderResource::class;
                break;
            case 'sale':
                $resources[$key] = \App\Http\Resources\Home\SaleResource::class;
                break;
            case 'categories[0]':
                $resources[$key] = \App\Http\Resources\Home\Categories0Resource::class;
                break;
            case 'categories[1]':
                $resources[$key] = \App\Http\Resources\Home\Categories1Resource::class;
                break;
            case 'lists':
                $resources[$key] = \App\Http\Resources\Home\ListsResource::class;
                break;
            case 'banners':
                $resources[$key] = \App\Http\Resources\Home\BannersResource::class;
                break;
            case 'news':
                $resources[$key] = \App\Http\Resources\Home\NewsResource::class;
                break;
        }

        foreach ($resources as $resource) {
            $values =
                $this->convertToResource(
                    $model,
                    $resource::collection($model->find($this->jsonValueFormat()))
                );
        }
        return $values;
    }
    private function convertToResource($model,$resource){

//        dd($resource->resource);
        return !is_null($model) ?
            $resource->resource : $this->jsonValueFormat();
    }
    private function jsonFormat(){
        $model = null;
        if(!is_null($this->attributes['model'])) {
            $modelName = config('morphmap')[$this->attributes['model']];
            $model = (new $modelName);
        }
        return !is_null($model) ? $this->convertKeyToValue($this->attributes['key'],$model) : $this->jsonValueFormat();
    }
    private function jsonValueFormat(){
        return (array)json_decode($this->attributes['value'],true);
    }
    public function getJsonAttribute(): array
    {
        if(!is_null($this->attributes['value']) && $this->attributes['value']!='') {
            $values = $this->jsonFormat();
            $key = $this->attributes['key'];
            return [
                $key => $values
            ];
        }
        return [];
    }
}
