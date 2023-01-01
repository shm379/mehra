<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function line_item()
    {
        return $this->morphTo();
    }

    public function address()
    {
        return $this->belongsTo(UserAddress::class);
    }
}
