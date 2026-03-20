<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasApprovedBrand
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->hasApprovedBrand()) {
            return redirect()->route('brand-owner.dashboard')
                ->with('warning', 'Your brand must be approved before you can publish posts.');
        }
        return $next($request);
    }
}
