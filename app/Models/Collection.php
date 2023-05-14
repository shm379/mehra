<?php

namespace App\Models;

use App\Enums\CollectionType;
use App\Enums\ProductStructure;
use App\Services\Media\HasMediaTrait;
use App\Services\Media\Media;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Book;
use Spatie\Tags\HasTags;
use function Symfony\Component\Translation\t;

class Collection extends Model implements HasMedia
{
    use HasFactory, HasMediaTrait , HasTags;
    protected $guarded = [];

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
                'products'=>function($t){
                    return $t->with('medias');
                },
            ])
            ->where($this->getRouteKeyName(), $value)
            ->firstOrFail();
    }
    public static function getValidCollections(): array
    {
        return [
            'image',
        ];
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->useDisk(config('media-library.disk_name'))->singleFile();
    }

    public function getRouteKeyName(): string
    {
        return 'id';
    }

    public function items()
    {
        return $this->belongsToMany(CollectionItem::class,'collection_item','item_id','collection_id')
            ->when($this->type == CollectionType::PRODUCT, function ($query) {
                return $query->whereType('product');
            })
            ->when($this->type == CollectionType::CATEGORY, function ($query) {
                return $query->whereType('category');
            })
            ->when($this->type == CollectionType::ATTRIBUTE, function ($query) {
                return $query->whereType('attribute');
            })
            ->when($this->type == CollectionType::CREATOR, function ($query) {
                return $query->whereType('creator');
            });
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'item','collection_item');
    }
    public function books()
    {
        return $this->morphedByMany(Book::class, 'item','collection_item');
    }
    public function creators()
    {
        return $this->morphedByMany(Creator::class, 'item','collection_item');
    }
    public function producers()
    {
        return $this->morphedByMany(Producer::class, 'item','collection_item');
    }
    public function categories()
    {
        return $this->morphedByMany(Category::class, 'item','collection_item');
    }
    public function attributeValues()
    {
        return $this->morphedByMany(AttributeValue::class, 'item','collection_item');
    }
}
