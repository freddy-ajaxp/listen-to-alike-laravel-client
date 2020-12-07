<?php

namespace App\Http\Middleware;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Closure;

class SessionValidator
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
        if($request->session()->has('email')){
            // if (Route::currentRouteName('/register') || Route::currentRouteName('/login')) { 
            if ($request->is('register') || $request->is('login')) { 
                return redirect("/dashboard");
              }
              else{
                return $next($request);
              }
            
        }
        else {
            if ($request->is('register') || $request->is('login')) { 
                return $next($request);
              }
              else{
                return redirect("/login");                
              }
            
        }
        
        
    }
}
