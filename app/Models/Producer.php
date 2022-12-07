<?php

namespace App\Models;

use App\Enums\ProducerType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\Media\HasMediaTrait;
use App\Services\Media\Media;
use Spatie\MediaLibrary\HasMedia;

class Producer extends Model implements HasMedia
{
    use HasFactory, HasMediaTrait;
    protected $guarded = [];
    protected $appends = ['producer_type'];
    protected $casts = [
//        'producer_type' => ProducerType::class,
    ];

    public function getRouteKeyName(): string
    {
        return 'id';
    }

    public static function getValidCollections(): array
    {
        return [
            'logo',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')->singleFile();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'producer_id');
    }

    public function getProducerTypeAttribute()
    {
        return ProducerType::getDescription($this->attributes['type']);
    }

    public function scopePublishers($query,$q=null)
    {
        $query->where('type',ProducerType::PUBLISHER);
        if(isset($q)){
            $query->where('title','LIKE', '%' . $q . '%');
        }
        return $query->get();
    }

    public function scopeBrands($query,$q=null)
    {
        $query->where('type',ProducerType::BRAND);
        if(isset($q)){
            $query->where('title','LIKE', '%' . $q . '%');
        }
        return $query->get();
    }

    public function scopeProducers($query,$q=null)
    {
        $query->where('type',ProducerType::PRODUCER);
        if(isset($q)){
            $query->where('title','LIKE', '%' . $q . '%');
        }
        return $query->get();
    }
}
