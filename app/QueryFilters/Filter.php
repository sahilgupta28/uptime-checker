<?php

namespace App\QueryFilters;

use Closure;

abstract class Filter
{
    public function handle($request, Closure $next)
    {
        $builder = $next($request);
        return $this->applyFilter($builder);
    }

    abstract protected function applyFilter($builder);
}
