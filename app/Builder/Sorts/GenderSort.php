<?php

namespace App\Builder\Sorts;

use App\Enums\UserGender;
use \Illuminate\Database\Eloquent\Builder;

class GenderSort implements \Spatie\QueryBuilder\Sorts\Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';
        foreach ([UserGender::MALE, UserGender::FEMALE] as $gender) {
            $query->orderByRaw('gender = ? '.$direction, [$gender]);
        }
    }
}
