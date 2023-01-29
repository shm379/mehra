<?php

namespace App\Models;

use App\Services\Media\HasMediaTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class Category extends Model implements HasMedia
{
    protected $guarded = [];
    use HasFactory, HasMediaTrait;

    public static function getValidCollections(): array
    {
        return [
            'image',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
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
                'parent',
                'children',
                'collections'=>function($collection){
                    $collection->with(['products']);
                }
            ])
            ->where($this->getRouteKeyName(), $value)
            ->firstOrFail();
    }

    public function getRouteKeyName(): string
    {
        return 'id';
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id')
            ->orderBy('created_at');
    }

    public function template()
    {
       return $this->belongsTo(CategoryTemplate::class,'category_template_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'category_product','category_id')
            ->using(CategoryProduct::class);
    }

    public function books()
    {
        return $this->belongsToMany(
            Book::class,
            'category_product',
            'category_id',
            'product_id'
            )
            ->using(CategoryProduct::class);
    }

    public function collections()
    {
        return $this->morphedByMany(Category::class, 'item','collection_item','item_id')
            ->with('products')
            ->withPivot('collection_id')
            ->using(CollectionItem::class);
    }

    public function collection_products()
    {
        return $this->morphToMany(Collection::class, 'item','collection_item');
    }


}
