<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tartan\Larapay\Payable;

class Order extends Model
{
    use HasFactory;
    use Payable;
    protected $appends = ['is_cart'];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function notes()
    {
        return $this->hasMany(OrderNote::class);
    }

    public function getIsCart()
    {
        if($this->attributes['type']==OrderStatus::CARD)
            return true;
        return false;
    }
}
