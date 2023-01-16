<?php

namespace App\Services\Media;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class TemporaryUploadPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        return $this->getBasePath($media). '/' . md5($media->id . $media->uuid . 'original') . '/';
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getBasePath($media). '/' . md5($media->id . $media->uuid . 'conversion');
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media). '/' . md5($media->id . $media->uuid . 'responsive');
    }

    /*
    * Get a unique base path for the given media.
    */
    protected function getBasePath(Media $media): string
    {
        $date = jdate(now());

        $prefix = config('media-library.prefix', '');

        $key = md5($media->uuid . $media->getKey());

        if ($prefix !== '') {
            return $date->getYear() . '/' . $date->getMonth() . '/temp_dir/' . $prefix . '/' . $key;
        }

        return $date->getYear() . '/' . $date->getMonth() . '/temp_dir/' .$key;
    }
}
