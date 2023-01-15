<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory;
    use SoftDeletes;
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
