<?php

namespace App\Http\Resources;

use App\Helpers\Helpers;


class NotificationResource extends MehraResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'discount'=> $this->discount,
            'type'=> $this->activity_type,
            'body'=> $this->message,
            'date'=> $this->sent_at,
            'is_readed'=> !is_null($this->read_at),
            'read_at'=> $this->read_at,
        ];
    }
}
