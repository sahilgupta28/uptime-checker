<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsUser
{
    public function handle($request, Closure $next)
    {
        if (Auth::User()->role == config('constants.ROLE.USER')) {
            return $next($request);
        }
        return abort('403', 'Not Authorized');
    }
}
