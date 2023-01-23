<?php

namespace App\Models;

use App\Enums\SettingSection;
use App\Helpers\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Setting
{
    protected $table = 'settings';
    protected $appends = ['json'];
    protected $casts = [
      'where'=>'json'
    ];
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
    private function convertKeyToValue($key,$model)
    {
        $values = null;
        $resources = null;
        $name = ucfirst($key);
        if(str_ends_with($name,']')){
           $name = Helpers::removeBracketFromString($name);
        }
        $resources[$key] = "\App\Http\Resources\Api\Home\\{$name}ResourceCollection";
        foreach ($resources as $resourceKey=>$resource) {

            $values =
                $this->convertToResource(
                    $model,
                    new $resource($model->find($this->jsonValueFormat()))
                );
        }
        return $values;
    }
    private function convertToResource($model,$resource)
    {
        return !is_null($model) ?
            $resource : $this->jsonValueFormat();
    }
    private function jsonFormat()
    {
        $model = null;
        if(!is_null($this->attributes['model'])) {
            $modelName = config('morphmap')[$this->attributes['model']];
            $model = is_array($modelName) ? (new $modelName[0]) : (new $modelName);

            if(!is_null($this->attributes['with'])){
                $model = $model->with(json_decode($this->attributes['with'],  true));
            }
            if(!is_null($this->attributes['where'])){
                $model = $model->where(json_decode($this->attributes['where'],  true));
            }
        }
        return !is_null($model) ? $this->convertKeyToValue($this->attributes['key'],$model) : $this->jsonValueFormat();
    }
    private function jsonValueFormat()
    {
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
