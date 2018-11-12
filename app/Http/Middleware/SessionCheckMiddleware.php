<?php

namespace App\Http\Middleware;

use Closure;

class SessionCheckMiddleware
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
        if(! $this->isExceptPath($request) && is_null(\Auth::user())){
            return redirect("/errors/session/expired");
        }

        return $next($request);
    }

    private function isExceptPath($request)
    {
        return $request->is('auth/*')
            || $request->is('errors/*');
    }

}
