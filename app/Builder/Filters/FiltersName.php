<?php
namespace App\Builder\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersName implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->whereRaw("concat(first_name, ' ', last_name) like '%$value%' ");
    }
}
