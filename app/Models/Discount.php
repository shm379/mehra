<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class,'product_discounts');
    }

    public function scopeLimitProducts($query)
    {
        return !$this->attributes['all_products'];
    }
}
