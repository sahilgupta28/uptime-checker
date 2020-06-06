<?php

namespace App\QueryFilters;

use Closure;

class Offset extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->offset(request('offset') ?? config('constants.DEFAULT.OFFSET'));
    }
}
