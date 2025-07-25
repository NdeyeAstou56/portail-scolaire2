<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsParent
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'parent') {
            return $next($request);
        }
        abort(403, 'Accès refusé (Parent uniquement)');
    }
}

