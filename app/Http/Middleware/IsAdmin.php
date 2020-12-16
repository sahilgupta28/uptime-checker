<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (auth()->User()->role == config('constants.ROLE.ADMIN')) {
            return $next($request);
        }
        return abort('403', 'Not Authorized');
    }
}
