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
      return redirect("/login");
    }


    if (session()->get('admin') == 1) {
      if ($request->is('register') || $request->is('dashboard')) {
        return redirect("/admin");
      } else {
        return $next($request);
      }
    } elseif (session()->get('admin') == 0) {
      if ($request->is('register') || $request->is('admin/*') || $request->is('admin')) {
        return redirect("/dashboard");
      } else {
        return $next($request);
      }
    } elseif (!session()->has('email')) {
      return redirect("/login");
    }
  }
}
