<?php

namespace App\Http\Middleware;

use Closure;
use \Illuminate\Foundation\Auth\User;

class CheckIp
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
        // $user =  User::all();

        // dd($user);


        return $next($request);
    }
}
