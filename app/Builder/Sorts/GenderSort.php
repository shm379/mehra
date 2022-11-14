<?php

namespace App\Builder\Sorts;

use \Illuminate\Database\Eloquent\Builder;

class GenderSort implements \Spatie\QueryBuilder\Sorts\Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';
        $query->orderByRaw("CASE gender
            WHEN 1 THEN 'آقا'
            WHEN 2 THEN 'خانم'
        END");
    }
}
