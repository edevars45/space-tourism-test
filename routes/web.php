<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PlanetController;

/*
|-----------------------------------------------------------------------------
| Routes web – Partie 04
|-----------------------------------------------------------------------------
| Je redirige l’accueil vers /login pour forcer l’authentification.
*/
Route::redirect('/', '/login');

/*
|-----------------------------------------------------------------------------
| Dashboard (Breeze)
|-----------------------------------------------------------------------------
| J’exige un utilisateur connecté et vérifié avant d’afficher le tableau de bord.
*/
Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|-----------------------------------------------------------------------------
| Profil (Breeze)
|-----------------------------------------------------------------------------
| Je laisse l’utilisateur gérer son profil une fois connecté.
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|-----------------------------------------------------------------------------
| Back-office Admin
|-----------------------------------------------------------------------------
| Pour la partie 04, je protège le back-office avec le Gate "admin".
| Je n’utilise plus 'role:admin' ; je m’appuie sur le middleware natif 'can:admin'.
| Le Gate 'admin' est défini dans App\Providers\AppServiceProvider::boot().
*/
Route::middleware(['auth', 'can:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        // Je fournis le CRUD des planètes, sans la page 'show'.
        Route::resource('planets', PlanetController::class)->except('show');
    });

/*
|-----------------------------------------------------------------------------
| Auth (Breeze)
|-----------------------------------------------------------------------------
| Je charge les routes d’authentification générées par Breeze.
*/
require __DIR__.'/auth.php';
