<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
{
    $user = auth()->user();

    switch ($user->role) {
        case 'admin':
            return view('admin.dashboard');
        case 'enseignant':
            return view('enseignants.dashboard');
        case 'parent':
            return view('parent.dashboard');
        case 'eleve':
            return view('eleves.dashboard');
        default:
            abort(403); // ou redirect('/'), etc.
    }
}

}


