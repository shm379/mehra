<?php

namespace App\Models;

use App\Services\Media\HasMediaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class Creator extends Model implements HasMedia
{
    use HasFactory , HasMediaTrait;
    protected $guarded = [];

    public function getRouteKeyName(): string
    {
        return 'id';
    }

    public static function getValidCollections(): array
    {
        return [
            'avatar',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->useDisk(config('media-library.disk_name'))->singleFile();
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
//        $conversion = $this->addMediaConversion('thumbnail');
//
//        $crop = $media->getCustomProperty('crop');
//
//        if (!empty($crop)) {
//            $conversion->manualCrop($crop['width'], $crop['height'], $crop['left'], $crop['top']);
//        }
//
//        $conversion->nonQueued()->performOnCollections('image');
    }

    public function getNameAttribute()
    {
        return $this->attributes['first_name'].' '.$this->attributes['last_name'];
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'creator_product','creator_id','product_id');
    }

    public function awards()
    {
        return $this->belongsToMany(Award::class, 'creator_awards','creator_id');
    }

    public function types()
    {
        return $this->belongsToMany(CreatorType::class,'creator_creator_types');
    }

    public function scopeAuthors($query,$q=null)
    {
        $query->whereHas('types',function ($query){
            $query->where('name', 'نویسنده');
        });
        if(isset($q)){
            $query->where('title','LIKE', '%' . $q . '%');
        }
        return $query->get();
    }

    public function scopeTranslators($query,$q=null)
    {
        $query->whereHas('types',function ($query){
            $query->where('name', 'مترجم');
        });
        if(isset($q)){
            $query->where('title','LIKE', '%' . $q . '%');
        }
        return $query->get();
    }

    public function scopeNarrators($query,$q=null)
    {
        $query->whereHas('types',function ($query){
            $query->where('name', 'گوینده');
        });
        if(isset($q)){
            $query->where('title','LIKE', '%' . $q . '%');
        }
        return $query->get();
    }

    public function scopeIllustrators($query,$q=null)
    {
        $query->whereHas('types',function ($query){
            $query->where('name', 'تصویرگر');
        });
        if(isset($q)){
            $query->where('title','LIKE', '%' . $q . '%');
        }
        return $query->get();
    }
}
