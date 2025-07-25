<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
   public function store(Request $request): RedirectResponse
{
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        $request->session()->regenerate();

        $user = Auth::user();

        switch ($user->role) {
            case 'admin':
                return redirect()->intended('/admin/dashboard');
            case 'enseignant':
                return redirect()->intended('/enseignant/dashboard');
            case 'parent':
                return redirect()->intended('/parent/dashboard');
            case 'eleve':
                return redirect()->intended('/eleve/dashboard');
            default:
                Auth::logout();
                return redirect('/login')->withErrors(['role' => 'Rôle non autorisé.']);
        }
    }
        return back()->withErrors([
        'email' => 'Les identifiants sont incorrects.',
    ]);
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


}
