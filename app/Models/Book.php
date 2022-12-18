<?php

namespace App\Models;

use App\Enums\ProductStructure;
use App\Services\Media\HasMediaTrait;
use App\Services\Media\Media;
use App\Traits\LogsUserView;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class Book extends Product
{
    use LogsUserView;
    protected $table = 'products';

    public function getRouteKeyName(): string
    {
        return 'id';
    }

    public function newQuery($excludeDeleted = true): \Illuminate\Database\Eloquent\Builder
    {
        return parent::newQuery()->whereStructure(ProductStructure::BOOK);
    }

    public static function getValidCollections(): array
    {
        return [
            'cover_image',
            'back_image',
            'gallery',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover_image')->useDisk(config('media-library.disk_name'))->singleFile();
        $this->addMediaCollection('back_image')->useDisk(config('media-library.disk_name'))->singleFile();
        $this->addMediaCollection('gallery')->useDisk(config('media-library.disk_name'));
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
        return $this->belongsTo(Book::class,'parent_id');
    }

    public function volume()
    {
        return $this->belongsTo(Volume::class);
    }

    public function volumes()
    {
        return $this->hasMany(Book::class,'volume_id')->orderBy('order_volume');
    }

    public function scopeVolumeTitle($query, $title)
    {
        return Book::whereHas('volume', function ($query) use ($title) {
            $query->where('title', 'like', '%'.$title.'%');
        });
    }
}
