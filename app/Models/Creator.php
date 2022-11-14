<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getNameAttribute()
    {
        return $this->attributes['first_name'].' '.$this->attributes['last_name'];
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function types()
    {
        return $this->belongsToMany(CreatorType::class,'creator_creator_types');
    }

    public function scopeAuthors($query)
    {
        $query->whereHas('types',function ($query){
            $query->where('name', 'نویسنده');
        });
        return $query->get();
    }

    public function scopeTranslators($query)
    {
        $query->whereHas('types',function ($query){
            $query->where('name', 'مترجم');
        });
        return $query->get();
    }

    public function scopeSpeakers($query)
    {
        $query->whereHas('types',function ($query){
            $query->where('name', 'گوینده');
        });
        return $query->get();
    }

    public function scopeIllustrators($query)
    {
        $query->whereHas('types',function ($query){
            $query->where('name', 'تصویرگر');
        });
        return $query->get();
    }
}
