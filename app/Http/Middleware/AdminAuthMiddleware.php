<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // check if the user has the admin role
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
