<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpMonsters\Larapay\Payable;

class Order extends Model
{
    use HasFactory;
    use Payable;
    protected $guarded = [];
    protected $table = 'orders';
    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null): ?Model
    {
        return $this
            ->with(['address','user'=>function($user){
                $user->with('addresses');
            },'discount','items'=>function ($item){
                $item->with(['line_item'=>function ($line_item){
                    $line_item->with(['producer','medias']);
                }]);
            },'notes'])
            ->where($this->getRouteKeyName(), $value)
            ->firstOrFail();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function address()
    {
        return $this->belongsTo(UserAddress::class);
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
}
