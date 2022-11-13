<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function template()
    {
       return $this->belongsTo(CategoryTemplate::class,'category_template_id');
    }
    public function products()
    {
        return $this->belongsToMany(CategoryProduct::class);
    }

}
