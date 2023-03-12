<?php

namespace App\Models;

/**
 * @property-read string $type
 * @property-read string $extension
 * @property-read string $humanReadableSize
 * @property-read string $previewUrl
 * @property-read string $originalUrl
 */

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Filesystem;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;
use Spatie\MediaLibrary\Support\TemporaryDirectory;

class Media extends BaseMedia
{
    protected $with = ['medias'];
    public function medias()
    {
        return $this->morphToMany(config('media-library.media_model'), 'model','model_has_media')
            ->using(ModelHasMedia::class)
            ->withPivot([
                'order',
                'collection_name',
                'tag'
            ]);
    }
    public function users()
    {
        return $this->morphedByMany(User::class, 'model','model_has_media');
    }
    public function comments()
    {
        return $this->morphedByMany(Comment::class, 'model','model_has_media');
    }

    public function move(HasMedia $model, $collectionName = 'default', string $diskName = '', string $fileName = ''): self
    {
        $newMedia = $this->copy($model, $collectionName, $diskName, $fileName);

        $this->forceDelete();



        return $newMedia;
    }

    public function copy(HasMedia $model, $collectionName = 'default', string $diskName = '', string $fileName = ''): self
    {
        $temporaryDirectory = TemporaryDirectory::create();

        $temporaryFile = $temporaryDirectory->path('/') . DIRECTORY_SEPARATOR . $this->file_name;

        /** @var \Spatie\MediaLibrary\MediaCollections\Filesystem $filesystem */
        $filesystem = app(Filesystem::class);

        $filesystem->copyFromMediaLibrary($this, $temporaryFile);

        $fileAdder = $model
            ->addMedia($temporaryFile)
            ->usingName($this->name)
            ->setOrder($this->order_column)
            ->withCustomProperties($this->custom_properties);
        if ($fileName !== '') {
            $fileAdder->usingFileName($fileName);
        }
        $newMedia = $fileAdder
            ->toMediaCollection($collectionName, $diskName);

        $temporaryDirectory->delete();

        return $newMedia;
    }

}
