<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;

class Cors
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
        
        $allow_Ip = ['localhost','192.168.1.1','192.168.1.2','192.168.1.3','192.168.1.6','127.0.0.1','192.168.1.4'];
        $ip = Request::ip();

        if(in_array( $ip, $allow_Ip )){
            return $next($request);

        }else{
             return $next($request);
            //throw new Exception("Error Processing Request", 1);
            

        //      return $next($request)
        // ->header('Access-Control-Allow-Origin', 'localhost')
        // ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
             
        }

       
    }
}
