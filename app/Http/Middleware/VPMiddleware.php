<?php

namespace App\Http\Middleware;

use Closure;

class VPMiddleware
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
            $request->user()->role_id != 4)
            return Response(view('unauthorized')->with('role', 'Vice President(VP)'));
        return $next($request);
    }
}
