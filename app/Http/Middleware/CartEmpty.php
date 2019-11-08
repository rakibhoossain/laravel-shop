<?php

namespace App\Http\Middleware;

use Closure;
use Helper;

class CartEmpty
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
        if(Helper::cartCount() > 0){
            return $next($request);
        }
        return redirect('shop')->withErrors("Cart empty!");
    }
}
