<?php

namespace App\Models;

use App\Services\Media\HasMediaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class Slider extends Model implements HasMedia
{
    use HasFactory, HasMediaTrait;
    protected $with = ['medias'];
    protected static function getValidCollections(): array
    {
        return [
            'main_image',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main_image')->useDisk(config('media-library.disk_name'))->singleFile();
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $conversion = $this->addMediaConversion('thumbnail');

        $crop = $media->getCustomProperty('crop');

        if (!empty($crop)) {
            $conversion->manualCrop($crop['width'], $crop['height'], $crop['left'], $crop['top']);
        }

        $conversion->nonQueued()->performOnCollections('main_image');
    }
    /**
     * Get the settings.
     */
}
