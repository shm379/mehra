<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['profit'];
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
                $item->where('line_item_type','!=','shipping')->with(['line_item'=>function ($line_item){
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
    public function products()
    {
        return $this
            ->morphedByMany(Product::class,'line_item','order_items')
            ->withPivot([
                'deleted_at',
                'quantity',
                'is_virtual',
                'discount_applied',
                'discount_amount',
                'main_price',
                'price',
                'total_discount_amount',
                'total_main_price',
                'total_price',
                'line_item_type',
                'line_item_id',
            ]);
    }
    public function shipping()
    {
        return $this->morphedByMany(Shipping::class,'line_item','order_items');
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
        $discount_amount = $this->attributes['total_main_price'] ?? 0;
        return $this->attributes['total_final_price'] - $discount_amount;
    }
}
