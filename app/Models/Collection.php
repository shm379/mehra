<?php

namespace App\Models;

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
        return $this->belongsToMany(Product::class, 'collection_product','collection_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'collection_product','collection_id','product_id');
    }
}
