<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuthCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @Todo - implement http basic auth
     */
    public function handle($request, Closure $next)
    {
        //return response('This shit is working', 403);
        return $next($request);
    }
}
