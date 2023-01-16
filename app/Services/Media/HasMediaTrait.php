<?php
declare(strict_types=1);

namespace App\Services\Media;

use App\Models\ModelHasMedia;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\InteractsWithMedia as BasicHasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use App\Models\Media;

trait HasMediaTrait
{
    use BasicHasMedia;
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
    public function mediaModel()
    {
        return $this->morphMany(ModelHasMedia::class, 'model')->has('media');
    }


    public function getMediaRepository(): MediaRepository
    {
        return app(MediaRepository::class);
    }


    public function getMedias(string $collectionName = 'default', array|callable $filters = [])
    {
        return $this->getMediaRepository()
            ->getCollection($this, $collectionName, $filters)
            ->collectionName($collectionName);
    }

    public function loadMedia(string $collectionName): Collection
    {
        $collection = $this->exists
            ? $this->loadMissing('medias')->medias
            : collect($this->unAttachedMediaLibraryItems)->pluck('medias');

        $collection = new MediaCollection($collection);

        return $collection
            ->filter(fn (Media $mediaItem) => $mediaItem->pivot->collection_name === $collectionName)
            ->sortBy('pivot.order')
            ->values();
    }
    /*
    * Determine if there is media in the given collection.
    */
    public function hasMedia(string $collectionName = 'default', array $filters = []): bool
    {
        return count($this->getMedias($collectionName, $filters)) ? true : false;
    }

    public function getFirstMedias(string $collectionName = 'default', $filters = []): ?Media
    {
        $media = $this->getMedias($collectionName, $filters);
        return $media->first();
    }

    /*
     * Get the url of the image for the given conversionName
     * for first media for the given collectionName.
     * If no profile is given, return the source's url.
     */
    public function getFirstMediaUrl(string $collectionName = 'default', string $conversionName = ''): string
    {
        $media = $this->getFirstMedias($collectionName);
        if (! $media) {
            return $this->getFallbackMediaUrl($collectionName, $conversionName) ?: '';
        }

        if ($conversionName !== '' && ! $media->hasGeneratedConversion($conversionName)) {
            return $media->getUrl();
        }

        return $media->getUrl($conversionName);
    }


    public static function isValidMediaCollection(string $collectionName): bool
    {
        return in_array($collectionName, static::getValidCollections());
    }

    protected static function getValidCollections(): array
    {
        return [];
    }
}
