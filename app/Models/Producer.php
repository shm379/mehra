<?php

namespace App\Models;

use App\Enums\ProducerType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['producer_type'];
    protected $casts = [
//        'producer_type' => ProducerType::class,
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getProducerTypeAttribute()
    {
        return ProducerType::getDescription($this->attributes['producer_type']);
    }

    public function scopePublishers($query,$q=null)
    {
        $query->where('producer_type',ProducerType::PUBLISHER);
        if(isset($q)){
            $query->where('title','LIKE', '%' . $q . '%');
        }
        return $query->get();
    }

    public function scopeBrands($query,$q=null)
    {
        $query->where('producer_type',ProducerType::BRAND);
        if(isset($q)){
            $query->where('title','LIKE', '%' . $q . '%');
        }
        return $query->get();
    }

    public function scopeProducers($query,$q=null)
    {
        $query->where('producer_type',ProducerType::PRODUCER);
        if(isset($q)){
            $query->where('title','LIKE', '%' . $q . '%');
        }
        return $query->get();
    }
}
