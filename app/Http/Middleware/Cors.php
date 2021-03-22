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
        
        $allow_Ip = ['192.168.43.1','127.0.0.1','192.168.43.249'];

        $ip = Request::ip();

        if(in_array( $ip, $allow_Ip )){
            return $next($request);

        }else{

        //      return $next($request)
        // ->header('Access-Control-Allow-Origin', 'localhost')
        // ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
             
        }

       
    }
}
