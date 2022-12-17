<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $guarded = [];
    protected $appends = [
        'expire_at'
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class,'product_discounts');
    }

    public function scopeLimitProducts($query)
    {
        return !$this->attributes['all_products'];
    }

    public function getExpireAtAttribute()
    {
        return !is_null($this->attributes['end_time']) ?
            $this->attributes['end_time'] :
            $this->attributes['expire_at'] ;
    }
}
