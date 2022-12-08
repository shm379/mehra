<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\UserFollowType;
use App\Services\Media\HasMediaTrait;
use App\Traits\MustVerifyMobile;
use Fouladgar\OTP\Concerns\HasOTPNotify;
use Fouladgar\OTP\Contracts\OTPNotifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasPermissions;
    use HasRoles;
    use HasMediaTrait;
    use MustVerifyMobile;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'name',
    ];

    public function getNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public static function getValidCollections(): array
    {
        return [
            'avatar',
        ];
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $conversion = $this->addMediaConversion('thumbnail');

        $crop = $media->getCustomProperty('crop');

        if (!empty($crop)) {
            $conversion->manualCrop($crop['width'], $crop['height'], $crop['left'], $crop['top']);
        }

        $conversion->nonQueued()->performOnCollections('main_image');
    }

    public function follows()
    {
        return $this->hasMany(UserFollow::class,'follow_id');
    }

    public function followers()
    {
        return $this->follows()->where('type',UserFollowType::FOLLOWER);
    }

    public function following()
    {
        return $this->follows()->where('type',UserFollowType::FOLLOWING);
    }

    public function histories()
    {
        return $this->belongsToMany(UserSearchHistory::class);
    }

    public function views()
    {
        return $this->belongsToMany(UserView::class);
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function announcements()
    {
        return $this->belongsToMany(Announcement::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function getBalanceAttribute() : int
    {
        return $this->wallet->balance;
    }

    public function scopeGetOrders($query,$user_id): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        $order = $this->orders()->with(['items'=>function($i){
                $i->with('load');
            }
        ])->find($user_id);
        $order->total_price = $order->items()->sum('total_price');
        $order->total_price_without_discount = $order->items()->sum('total_price_without_discount');
        return $this->orders()->with('items');
    }

    public function scopeGetCart($query,$user_id)
    {
        if($user_id) {
            $order = $query->find($user_id)->orders()
                ->where('status', OrderStatus::CART)
                ->with(['items'=>function ($i){
                        $i->with('media');
                    }
                ]);
            if (!$order->exists()) {
                return $query->where('id', null);
            }

            $order = $order->first();
            return $order;
        } else {
            return $query->where('id', null);
        }
    }

    /**
     * @param Builder $builder
     * @param string $relation - The relation to join
     */
    public function scopeJoinRelation(Builder $query, string $relation) {
        $join_query = self::RelationToJoin($relation, $relation);
        $query->join($join_query->table . ' AS ' . $relation, function(JoinClause $builder) use($join_query) {
            return $builder->mergeWheres($join_query->wheres, $join_query->bindings);
        });
        return $query;
    }


    /*
     * for KAVENEGAR notification system
     */
    public function routeNotificationForKavenegar($driver, $notification = null)
    {
        return $this->mobile;
    }
}
