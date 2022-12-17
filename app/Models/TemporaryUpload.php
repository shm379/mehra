<?php

namespace App\Models;

use Spatie\MediaLibraryPro\Models\TemporaryUpload as SpatieTemporaryUpload;

class TemporaryUpload extends SpatieTemporaryUpload
{
    /**
     * @return string
     */
    protected static function getDiskName(): string
    {
        return config('media-library.disk_name');
    }
}