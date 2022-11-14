<?php

namespace App\Builder\Sorts;

use \Illuminate\Database\Eloquent\Builder;

class GenderSort implements \Spatie\QueryBuilder\Sorts\Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';
        foreach (['1', '2'] as $gender) {
            $query->orderByRaw('gender = ? '.$direction, [$gender]);
        }
    }
}
