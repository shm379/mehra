<?php

namespace App\Http\Resources\Api;

class BookAttributeResourceCollection extends MehraResourceCollection
{
    public function toArray($request)
    {
        return $this->groupBy('attribute.name'); // TODO: Change the autogenerated stub
    }
}