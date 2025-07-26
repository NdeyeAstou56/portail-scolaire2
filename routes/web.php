<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\AnneeScolaireController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\AffectationController;




Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::get('/eleves', [EleveController::class, 'index'])->name('eleves.index');
Route::get('/enseignants', [EnseignantController::class, 'index'])->name('enseignants.index');
Route::get('/classes', [ClasseController::class, 'index'])->name('classes.index');
Route::get('/bulletins', [BulletinController::class, 'index'])->name('bulletins.index');
Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
Route::get('/niveaux', [NiveauController::class, 'index'])->name('niveaux.index');
Route::get('/matieres', [MatiereController::class, 'index'])->name('matieres.index');
Route::get('/affectations', [AffectationController::class, 'index'])->name('affectations.index');
Route::get('/periodes', [PeriodeController::class, 'index'])->name('periodes.index');
Route::get('/annees', [AnneeScolaireController::class, 'index'])->name('annees.index');


// Routes accessibles uniquement si l'utilisateur est connecté
Route::middleware(['auth'])->group(function () {
    
    Route::resource('eleves', EleveController::class)->parameters([
        'eleves' => 'eleve',
    ]);

    Route::resource('enseignants', EnseignantController::class);
    Route::resource('classes', ClasseController::class);
    Route::resource('notes', NoteController::class);
    Route::resource('bulletins', BulletinController::class);
    Route::resource('periodes', PeriodeController::class);
    Route::resource('annees', AnneeScolaireController::class);
    Route::resource('niveaux', NiveauController::class);
    Route::resource('matieres', MatiereController::class);
    Route::resource('affectations', AffectationController::class);
});



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


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


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
