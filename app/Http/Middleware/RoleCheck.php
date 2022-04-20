<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        // tolong perhatikan kernel http nya, pasangin ke route middleware, perhatikan juga model nya apakah role atau level
        if(in_array($request->user()->role,$levels)) {
            return $next($request);
        }
        return redirect('admin/')->with('access_denied', 'Ups! anda tidak memiliki akses');
    }
}
