<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsBrandOwner
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isBrandOwner()) {
            abort(403, 'Access denied.');
        }
        return $next($request);
    }
}
