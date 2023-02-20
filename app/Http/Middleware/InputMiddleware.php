<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class InputMiddleware
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
            $request->user()->role_id != 12 &&
            $request->user()->role_id != 11 &&
            $request->user()->role_id != 10 &&
            $request->user()->role_id != 9 &&
            $request->user()->role_id != 8 &&
            $request->user()->role_id != 5 && 
            $request->user()->role_id != 4 && 
            $request->user()->role_id != 3 && 
            $request->user()->role_id != 2 && 
            $request->user()->role_id != 1)
            return Response(view('unauthorized')->with('role', 'Admin/Karyawan/Manager/VP/CEO/CO/CFO/Finance/AssetManagement/HR'));
        return $next($request);
    }
}
