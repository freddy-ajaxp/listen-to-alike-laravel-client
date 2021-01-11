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


    // dd(session()->get('admin'));
    if (session()->get('email') === null) {
      if ($request->is('login') || $request->is('register') ) {
        return $next($request);

      }
      else {
        return redirect("/login");
      }
      
    }

    if (session()->get('admin') > 0) {
      if ($request->is('register') || $request->is('dashboard') || $request->is('login')) {
        return redirect("/admin");
      } else {
        return $next($request);
      }
    } 
    
    if (session()->get('admin') == 0) {
      if ($request->is('register') || $request->is('admin/*') || $request->is('admin') || $request->is('login')) {
        return redirect("/dashboard");
      } else {
        return $next($request);
      }
    } 
    // elseif (!session()->has('email')) {
    //   return redirect("/login");
    // }
  }
}
