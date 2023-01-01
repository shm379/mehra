<?php

namespace App\Http\Resources\Admin;

use App\Enums\OrderNoteStatus;
use App\Enums\OrderNoteType;
use App\Enums\ProductStructure;
use App\Helpers\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;


class OrderNoteResource extends JsonResource
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
            "id"=>$this->id,
            "order_id"=>$this->order_id,
            "note"=>$this->note,
            "status"=> $this->status,
            "type"=> OrderNoteType::getDescription((int)$this->type),
            "created_at"=>optional($this->created_at)->diffForHumans(),
            "updated_at"=>optional($this->created_at)->diffForHumans(),
            "admin_id"=>optional($this->admin)->name,
        ];
    }
}
