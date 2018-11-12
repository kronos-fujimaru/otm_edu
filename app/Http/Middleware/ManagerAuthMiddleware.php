<?php

namespace App\Http\Middleware;

use Closure;

class ManagerAuthMiddleware
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
        if(\Auth::user()->isManager() == false){
            abort(404);
        }
        return $next($request);
    }
}
