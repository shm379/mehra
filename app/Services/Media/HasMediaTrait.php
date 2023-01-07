<?php
declare(strict_types=1);

namespace App\Services\Media;

use App\Models\ModelHasMedia;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\InteractsWithMedia as BasicHasMedia;
trait HasMediaTrait
{
    use BasicHasMedia;
    public function medias()
    {
        return $this->morphToMany(config('media-library.media_model'), 'model','model_has_media')
            ->using(ModelHasMedia::class)
            ->withPivot([
                'order',
                'tag'
            ]);
    }
    public function main_image()
    {
        return $this->morphOne(Media::class, 'model')->where('collection_name', 'main_image');
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
