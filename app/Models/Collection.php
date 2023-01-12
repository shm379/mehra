<?php

namespace App\Models;

use App\Enums\ProductStructure;
use App\Services\Media\HasMediaTrait;
use App\Services\Media\Media;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Book;
class Collection extends Model implements HasMedia
{
    use HasFactory, HasMediaTrait;
    protected $guarded = [];

    public static function getValidCollections(): array
    {
        return [
            'image',
        ];
    }


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
                'medias',
                'products',
            ])
            ->where($this->getRouteKeyName(), $value)
            ->firstOrFail();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->useDisk(config('media-library.disk_name'))->singleFile();
    }

    public function getRouteKeyName(): string
    {
        return 'id';
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'item','collection_item');
    }
}
