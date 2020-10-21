<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class ApiGuard
{
    /**
     * @param          $request
     * @param \Closure $next
     * @param null     $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if($guard != null)
            auth()->shouldUse($guard);
        return $next($request);
    }
}
