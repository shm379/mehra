<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Order
{
    protected $table = 'orders';

    public function newQuery($excludeDeleted = true): \Illuminate\Database\Eloquent\Builder
    {
        return parent::newQuery()
            ->whereStatus(OrderStatus::CART)
            ->where('user_id',auth()->guard('sanctum')->id());
    }
}
