<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Pasien
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {            
            return $next($request);
        }
    
        if (auth()->user()->role !== 'pasien') {
            abort(403);
        }
        
        return $next($request);
    }
}
