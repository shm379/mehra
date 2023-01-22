<?php

namespace App\Models;

use App\Enums\ProductStructure;
use App\Services\Media\HasMediaTrait;
use App\Services\Media\Media;
use App\Traits\LogsUserView;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Spatie\MediaLibrary\HasMedia;

class Book extends Product
{
    use LogsUserView;
    protected $table = 'products';

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null): ?Model
    {
        return $this
            ->with([
              'rank_attributes',
             'comments'=>function($comment){
                $comment->with(['medias','user'])->limit(3);
             },
            'medias',
            'volumes',
            'producer',
            'productRelated',
            'creators'=>function($creator){
                $creator->with('types','medias');
            },
            'attributeValues'=>function($value) {
                $value->with('attribute');
            }
            ])
            ->where($this->getRouteKeyName(), $value)
            ->firstOrFail();
    }
    public function getRouteKeyName(): string
    {
        return 'id';
    }

    public static function getValidCollections(): array
    {
        return [
            'cover_image',
            'back_image',
            'gallery',
            'excerpt',
        ];
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('تصویر جلد کتاب')
            ->useDisk(config('media-library.disk_name'))
            ->acceptsMimeTypes(['images/*'])
            ->singleFile();
        $this->addMediaCollection('تصویر پشت کتاب')
            ->useDisk(config('media-library.disk_name'))
            ->acceptsMimeTypes(['images/*'])
            ->singleFile();
        $this->addMediaCollection('گالری')
            ->useDisk(config('media-library.disk_name'))
            ->acceptsMimeTypes(['images/*']);
        $this->addMediaCollection('فایل خلاصه کتاب')
            ->useDisk(config('media-library.disk_name'))
            ->acceptsMimeTypes(['application/pdf'])
            ->singleFile();
        $this->addMediaCollection('فایل صوتی نمونه')
            ->useDisk(config('media-library.disk_name'))
            ->acceptsMimeTypes(['audio/*']);
        $this->addMediaCollection('فایل صوتی اصلی')
            ->useDisk(config('media-library.disk_name'))
            ->acceptsMimeTypes(['audio/*']);
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


    public function rank_attributes()
    {
        return $this->belongsToMany(RankAttribute::class, 'ranks','product_id')
            ->using(Rank::class)
            ->withPivot(['comment_id','user_id','rank_attribute_id','product_id','score']);
    }

    public function parent()
    {
        return $this->belongsTo(Book::class,'parent_id');
    }

    public function volume()
    {
        return $this->belongsTo(Volume::class);
    }

    public function volumes()
    {
        return $this->hasMany(Book::class,'volume_id')->with('volume')->orderBy('order_volume');
    }

    public function scopeVolumeTitle($query, $title)
    {
        return Book::whereHas('volume', function ($query) use ($title) {
            $query->where('title', 'like', '%'.$title.'%');
        });
    }
}
