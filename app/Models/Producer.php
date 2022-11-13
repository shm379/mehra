<?php

namespace App\Models;

use App\Enums\ProducerType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['producer_type'];
    protected $casts = [
//        'producer_type' => ProducerType::class,
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getProducerTypeAttribute()
    {
        return ProducerType::getDescription($this->attributes['producer_type']);
    }
}
