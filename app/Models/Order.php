<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['profit','shipping_price'];
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

    public function scopeWithItems($query)
    {
        return $query->with([
            'items'=>function ($item) {
                $item->with(['line_item' => function ($line_item) {
                    $line_item->with(['producer', 'medias']);
                }]);
            }
        ]);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function notes()
    {
        return $this->hasMany(OrderNote::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getProfitAttribute()
    {
        if(isset($this->attributes['total_price_without_shipping']) || isset($this->attributes['total_price_without_sale_price'])) {
            $total = $this->attributes['total_price_without_shipping'] ?? $this->attributes['total_price_without_sale_price'];
        } else {
            $total = isset($this->attributes['total_price']) ?? $this->attributes['total_price'];
        }
        if(isset($this->attributes['total_price']))
            return $total - $this->attributes['total_price'];

        return $total - 0;
    }
    public function getShippingPriceAttribute()
    {
        return 0;
    }
}
