<?php

namespace App\Http\Middleware;

use Closure;

class AssetManagementMiddleware
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
            $request->user()->role_id != 11)
            return Response(view('unauthorized')->with('role', 'Asset Management'));
        return $next($request);
    }
}
