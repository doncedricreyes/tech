<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Library\BasicAuthSerializer;
use Auth;

class ApiAuthCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @Todo - implement http basic auth
     * Do auth. save what you need to the session
     */
    public function handle($request, Closure $next)
    {
        //return response('This shit is working', 403);
        $oSerializer = new BasicAuthSerializer('Y3VzdG9tZXJAZXhhbXBsZS5jb206cGFzc3dvcmQ=');

        if (Auth::guard('customer')->attempt(['email' => $oSerializer->getUsername(), 'password' => $oSerializer->getPassword()])) {
            
            return $next($request);
        }else{
           
            return response()->json(['error' => 'Not authorized.'],403);
        }
     


        
       
     
    }
}
