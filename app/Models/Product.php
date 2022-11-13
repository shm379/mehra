<?php

namespace App\Models;

use App\Enums\ProductRelatedType;
use App\Services\Media\HasMediaTrait;
use App\Services\Media\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, HasMediaTrait;
    protected $guarded = [''];
//    protected $appends = [''];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function getValidCollections(): array
    {
        return [
            'main_image',
            'gallery',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main_image')->singleFile();
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

    public function parent()
    {
        return $this->belongsTo(Product::class);
    }

    public function productRelated(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class,'product_related');
    }

    public function related(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->productRelated()->where('type',ProductRelatedType::RELATED);
    }

    public function upsell(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->productRelated()->where('type',ProductRelatedType::UPSELL);
    }

    public function cross_sell(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->productRelated()->where('type',ProductRelatedType::CROSS_SELL);
    }

    public function producer()
    {
        return $this->belongsTo(Producer::class);
    }

    public function volume()
    {
        return $this->belongsTo(Volume::class);
    }

    public function volumes()
    {
        return $this->hasMany(Product::class,'volume_id')->orderBy('order_volume');
    }

    public function groups()
    {
        return $this->belongsToMany(ProductGroup::class,'product_product_groups');
    }

    public function creators()
    {
        return $this->belongsToMany(Creator::class);
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class)->with('values')->withPivot(['value_id']);
    }

    public function awards()
    {
        return $this->belongsToMany(Award::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function rates()
    {
        return $this->belongsToMany(Rate::class);
    }
}
