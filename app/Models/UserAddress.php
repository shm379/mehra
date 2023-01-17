<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    protected $table = 'user_addresses';
    protected $guarded = ['user_id'];
    protected $with = ['user','state','city'];
    protected $appends = ['full_address'];
    use SoftDeletes;

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function getFirstNameAttribute()
    {
        return $this->for_me ? $this->user->first_name : $this->attributes['first_name'];
    }
    public function getLastNameAttribute()
    {
        return $this->for_me ? $this->user->last_name : $this->attributes['last_name'];
    }
    public function getPhoneNumberAttribute()
    {
        return $this->for_me ? $this->user->phone_number : $this->attributes['phone_number'];
    }
    public function getMobileAttribute()
    {
        return $this->for_me ? $this->user->mobile : $this->attributes['mobile'];
    }
    public function getFullAddressAttribute()
    {
        $separator = '-';
        $address = [];
        $address['state'] = 'استان ' . $this->state->title;
        $address['city'] = 'شهر ' . $this->city->title;
//        $hasDistrict = (bool)$this->attributes['district'];
//        if($hasDistrict)
//            $address['district'] = 'ناحیه ' . $this->attributes['district'];
//
        $address['address'] = $this->attributes['address'];
//        $address['unit'] = 'واحد ' . $this->attributes['unit'];
//        $address['plaque'] = 'پلاک ' . $this->attributes['plaque'];

        return implode($separator,$address);
    }
}
