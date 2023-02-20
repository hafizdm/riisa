<?php

namespace App\Http\Middleware;

use Closure;

class COMiddleware
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
        if($request->user() && 
            $request->user()->role_id != 8)
            return Response(view('unauthorized')->with('role', 'Cost Control (CO)'));
        return $next($request);
    }
}
