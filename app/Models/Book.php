<?php

namespace App\Models;

use App\Enums\ProductRelatedType;
use App\Services\Media\HasMediaTrait;
use App\Services\Media\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class Book extends Product
{
    protected $table = 'products';
    public function getRouteKeyName(): string
    {
        return 'id';
    }
    protected static function getValidCollections(): array
    {
        return [
            'cover_image',
            'back_image',
            'gallery',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover_image')->singleFile();
        $this->addMediaCollection('back_image')->singleFile();
        $this->addMediaCollection('gallery');
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
//        $conversion = $this->addMediaConversion('thumbnail');
//
//        $crop = $media->getCustomProperty('crop');
//
//        if (!empty($crop)) {
//            $conversion->manualCrop($crop['width'], $crop['height'], $crop['left'], $crop['top']);
//        }
//
//        $conversion->nonQueued()->performOnCollections('main_image');
    }

    public function creators()
    {
        return $this->belongsToMany(Creator::class,'creator_product','product_id')
            ->using(CreatorProduct::class)
            ->withPivot('creator_creator_type_id');
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class,'attribute_value_product','product_id')->with('attribute');
    }

    public function volume()
    {
        return $this->belongsTo(Volume::class);
    }

    public function volumes()
    {
        return $this->hasMany(Book::class,'volume_id')->orderBy('order_volume');
    }

    public function authors()
    {
        dd($this->creators()->get());
        return $this->creators();
    }
}
