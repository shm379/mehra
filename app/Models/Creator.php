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
