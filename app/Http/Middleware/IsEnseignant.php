<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsEnseignant
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'enseignant') {
            return $next($request);
        }
        abort(403, 'Accès refusé (Enseignant uniquement)');
    }
}

