<?php

namespace App\Models;

use App\Enums\AwardType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\Media\HasMediaTrait;
use App\Services\Media\Media;
use Spatie\MediaLibrary\HasMedia;

class Award extends Model implements HasMedia
{
    use HasFactory, HasMediaTrait;
    protected $guarded = [];
    protected $casts = [
//        'award_type'=> AwardType::class
    ];
    public function getRouteKeyName(): string
    {
        return 'id';
    }

    public static function getValidCollections(): array
    {
        return [
            'image',
            'cover_image',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->useDisk(config('media-library.disk_name'))->singleFile();
        $this->addMediaCollection('cover_image')->useDisk(config('media-library.disk_name'))->singleFile();
    }

    public function parent()
    {
        return $this->belongsTo($this,'parent_id');
    }

    public function scopeParentAwards($query)
    {
        return $query->whereNull('parent_id')->get();
    }

    public function scopeProducers($query,$q=null)
    {
        $query->where('type',AwardType::AWARD);
        if(isset($q)){
            $query->where('title','LIKE', '%' . $q . '%');
        }
        return $query->get();
    }
}
