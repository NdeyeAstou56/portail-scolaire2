<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
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

require __DIR__.'/auth.php';
