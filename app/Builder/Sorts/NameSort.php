<?php

namespace App\Builder\Sorts;

use \Illuminate\Database\Eloquent\Builder;

class NameSort implements \Spatie\QueryBuilder\Sorts\Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';
        $query->orderBy('last_name', $direction);
        $query->orderBy('first_name', $direction);
    }
}
