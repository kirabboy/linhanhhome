<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->guest()) {
            if (request()->isMethod('get')) {
                session()->put('url-redirect', $request->fullUrl());    
            }
            return redirect('quan-tri/dang-nhap');
        }
        return $next($request);
    }
}
