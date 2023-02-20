<?php

namespace App\Http\Middleware;

use Closure;

class CFOMiddleware
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
        $request->user()->role_id != 9)
        return Response(view('unauthorized')->with('role', 'CFO'));
    return $next($request);
    }
}
