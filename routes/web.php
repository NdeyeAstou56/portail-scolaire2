<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes pour l'utilisateur connecté
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboards selon le rôle
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});

Route::middleware(['auth', 'enseignant'])->group(function () {
    Route::get('/enseignant/dashboard', function () {
        return view('enseignant.dashboard');
    });
});

Route::middleware(['auth', 'parent'])->group(function () {
    Route::get('/parent/dashboard', function () {
        return view('parent.dashboard');
    });
});

Route::middleware(['auth', 'eleve'])->group(function () {
    Route::get('/eleve/dashboard', function () {
        return view('eleve.dashboard');
    });
});

// Ressource admin : gestion des utilisateurs
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
