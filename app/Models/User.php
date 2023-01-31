<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\UserFollowType;
use App\Services\Media\HasMediaTrait;
use App\Traits\MustVerifyMobile;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Manipulations;
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
        'city_id',
        'state_id',
        'gender',
        'type',
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
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    public static function getValidCollections(): array
    {
        return [
            'avatar',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->useDisk(config('media-library.disk_name'))
            ->acceptsMimeTypes(['image/jpeg','image/png','image/jpg'])
            ->singleFile();
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $conversion = $this->addMediaConversion('thumbnail');

        $crop = [];
        $crop['width'] = [];
        $crop['height'] = [];
        $crop['left'] = [];
        $crop['top'] = [];

//        if (!empty($crop)) {
            $conversion
                ->crop(Manipulations::CROP_CENTER,150,150)
                ->nonOptimized();
//        }

        $conversion->queued()->performOnCollections('avatar');
    }

    public function follows()
    {
        return $this->hasMany(UserFollow::class,'follow_id');
    }

    public function messages()
    {
        return $this->hasMany(Notification::class,'actor_id');
    }

    public function followers()
    {
        if($this->follows()->exists())
            return $this->follows()->where('type',UserFollowType::FOLLOWER);

        return $this->follows();
    }

    public function following()
    {
        if($this->follows()->exists())
            return $this->follows()->where('type',UserFollowType::FOLLOWING);

        return $this->follows();
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function histories()
    {
        return $this->belongsToMany(UserSearchHistory::class);
    }

    public function views()
    {
        return $this->hasMany(UserView::class);
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function wishlist()
    {
        return $this->hasMany(UserWishlist::class);
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
        return $this->orders()->with('items');
    }

    public function scopeGetCart($query,$user_id,$withoutShipping=true)
    {
        if($user_id) {
            $order = $query->find($user_id)->orders()
                ->where('status', OrderStatus::CART())
                ->with(['address','user'=>function ($u){
                    $u->with(['addresses']);
                },'items'=>function ($i) use ($withoutShipping){
                    if($withoutShipping) {
                        $i->where('line_item_type', '!=', 'shipping');
                    }
                    $i->with(['line_item'=>function ($l) use($withoutShipping){
                                if($withoutShipping)
                                    $l->with(['medias','producer']);
                            }
                        ]);
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

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsNotVerified()
    {
        return $this->forceFill([
            'email_verified_at' => null,
        ])->save();
    }
}
