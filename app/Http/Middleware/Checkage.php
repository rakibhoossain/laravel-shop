<?php

namespace App\Http\Middleware;

use Closure;

class Checkage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->age > 15) {
            die('Not allowed to login');
        }
        return $next($request);
    }
}
