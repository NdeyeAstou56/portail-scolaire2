<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsEleve
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'eleve') {
            return $next($request);
        }
        abort(403, 'Accès refusé (Élève uniquement)');
    }
}

