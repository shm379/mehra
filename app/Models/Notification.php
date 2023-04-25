<?php

namespace App\Models;

use App\Enums\NotificationActivityType;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Notification extends Model
{
    protected $fillable = [
        "notifier_id",
        "actor_id",
        "object_id",
        "object_type",
        "activity_type",
        "message_id",
        "body",
        "sent_at",
        'read_at',
    ];

    protected $casts = [
      'sent_at'=>'datetime',
      'read_at'=>'datetime',
    ];

    protected $appends = [
        'message',
        'is_read',
        'sent_at',
        'read_at'
    ];

    public function actor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'actor_id');
    }

    public function object(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function getActivityTypeAttribute()
    {
        return !is_null($this->attributes['activity_type']) ?
            NotificationActivityType::getDescription((int)$this->attributes['activity_type']) :
            $this->attributes['activity_type'];
    }

    public function getDiscountAttribute()
    {
        $discount = $this->messageModel()->first()->discount;
        if(!is_null($discount)) {
            return [
                'title' => $discount->title,
                'description' => $discount->description,
                'code' => $discount->code,
                'expire_at' => jdate($discount->expire_at)->format('Y-m-d H:i:s')
            ];
        } else {
            return null;
        }
    }

    public function getMessageAttribute()
    {
        if(!is_null($this->messageModel()->exists()))
            return $this->messageModel()->first()->message;
        return $this->attributes['message'];
    }

    public function messageModel()
    {
        return $this->belongsTo(Message::class,'message_id');
    }

    public function getIsReadAttribute(): int
    {
        return isset($this->read_at) ? 1 : 0;
    }

    public function getReadAtAttribute()
    {
        return
            isset($this->attributes['read_at']) ?
                jdate($this->attributes['read_at'])->format('Y-m-d H:i:s') :
                $this->attributes['read_at'];
    }

    public function getSentAtAttribute()
    {
        return
            isset($this->attributes['sent_at']) ?
                jdate($this->attributes['sent_at'])->format('Y-m-d H:i:s') :
                $this->attributes['sent_at'];
    }
}
