<?php

namespace App\Services\Media;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class TemporaryUploadPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        return $this->getBasePath($media).'/';
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getBasePath($media).'/conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media).'/responsive-images/';
    }

    /*
    * Get a unique base path for the given media.
    */
    protected function getBasePath(Media $media): string
    {
        if($media){
            $date = jdate($media->created_at);
        } else {
            $date = jdate(now());
        }

        $prefix = config('media-library.prefix', '');

        $key = md5($media->uuid . $media->getKey());

        if ($prefix !== '') {
            return $date->getYear() . '/' . $date->getMonth() . '/temp/' . $prefix . '/' . $key;
        }

        return $date->getYear() . '/' . $date->getMonth() . '/temp/' .$key;
    }
}
