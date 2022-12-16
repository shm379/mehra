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



}
