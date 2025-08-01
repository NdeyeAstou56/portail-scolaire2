<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
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
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Route logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Routes publiques
Route::get('/', function () {
    return view('welcome');
});

// Redirection dynamique après login selon le rôle
Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    switch ($role) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'enseignant':
            return redirect()->route('enseignant.dashboard');
        case 'parent':
            return redirect()->route('parent.dashboard');
        case 'eleve':
            return redirect()->route('eleve.dashboard');
        default:
            abort(403, 'Rôle non reconnu.');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Dashboards pour chaque rôle (pas besoin de middleware ici)
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/enseignant/dashboard', fn () => view('enseignants.dashboard'))->name('enseignant.dashboard');
Route::get('/parent/dashboard', fn () => view('parent.dashboard'))->name('parent.dashboard');
Route::middleware(['auth'])->group(function () {
    Route::get('/eleve/dashboard', [EleveController::class, 'portailEleve'])->name('eleve.dashboard');
    Route::get('/bulletins/{id}/download', [BulletinController::class, 'download'])->name('bulletins.download');
     Route::get('/eleve/mes-bulletins', [BulletinController::class, 'indexEleve'])->name('eleve.bulletins.index');
    Route::get('/eleve/bulletins/{id}', [BulletinController::class, 'showEleve'])->name('eleve.bulletins.show');
    Route::get('/eleve/bulletins/{id}/pdf', [BulletinController::class, 'downloadPDF'])->name('eleve.bulletins.download');
});


// Routes protégées par auth (tous les rôles connectés)
Route::middleware(['auth'])->group(function () {
    Route::get('eleves/{eleve}', [EleveController::class, 'show'])->name('eleves.show');
Route::put('eleves/{eleve}', [EleveController::class, 'update'])->name('eleves.update');
Route::delete('eleves/{eleve}', [EleveController::class, 'destroy'])->name('eleves.destroy');
Route::get('eleves/{eleve}/edit', [EleveController::class, 'edit'])->name('eleves.edit');
Route::resource('eleves', EleveController::class);

    Route::resource('enseignants', EnseignantController::class);
    Route::resource('classes', ClasseController::class);
    Route::resource('notes', NoteController::class);
    Route::resource('bulletins', BulletinController::class);
    Route::resource('periodes', PeriodeController::class);
    Route::resource('annees', AnneeScolaireController::class);
    Route::resource('niveaux', NiveauController::class);
    Route::resource('matieres', MatiereController::class);
    Route::resource('affectations', AffectationController::class);

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
