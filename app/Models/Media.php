<?php

namespace App\Models;

/**
 * @property-read string $type
 * @property-read string $extension
 * @property-read string $humanReadableSize
 * @property-read string $previewUrl
 * @property-read string $originalUrl
 */
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;
class Media extends BaseMedia
{
    public function medias()
    {
        return $this->morphedByMany(Media::class, 'model','model_has_media');
    }
    public function users()
    {
        return $this->morphedByMany(User::class, 'model','model_has_media');
    }
    public function comments()
    {
        return $this->morphedByMany(Comment::class, 'model','model_has_media');
    }
}
