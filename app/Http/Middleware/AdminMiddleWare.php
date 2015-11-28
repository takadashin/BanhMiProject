<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class AdminMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   if(Auth::check() && Auth::user()->role == User::$ADMIN_ROLE)
            return $next($request);
        return redirect("admin/login");
    }
}
