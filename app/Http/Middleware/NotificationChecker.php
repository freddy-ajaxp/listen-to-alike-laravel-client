<?php

namespace App\Http\Middleware;

use Closure;
use App\Notification;
class NotificationChecker
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
        $id_user = $request->session()->get('id');
        $data="";
        if($id_user){
            $data = Notification::select()
             ->where('notifiable_id', $id_user)
             ->whereNull('read_at') 
             ->count();
             
             session(['newNotification' => $data]);
        }
        return $next($request);        
    }
}
