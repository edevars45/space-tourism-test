<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PlanetController;

/*
|--------------------------------------------------------------------------
| Front public
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('vue.accueil'))->name('accueil');
Route::get('/destination', fn () => view('vue.destination'))->name('destination');
Route::get('/equipage', fn () => view('vue.equipage'))->name('equipage');
Route::get('/technologie', fn () => view('vue.technologie'))->name('technologie');

/*
|--------------------------------------------------------------------------
| Commutateur de langue (FR/EN)
|--------------------------------------------------------------------------
| Enregistre 'fr' ou 'en' en session puis revient à la page précédente.
| Utilisation : route('lang.switch', 'fr') / route('lang.switch', 'en')
*/
Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['fr', 'en'], true)) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

/*
|--------------------------------------------------------------------------
| Dashboard (Breeze)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profil (Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Back-office Admin (Partie 4 : CRUD Planètes)
|--------------------------------------------------------------------------
| Gate 'admin' défini dans App\Providers\AppServiceProvider::boot()
| (ex: Gate::define('admin', fn(User $u) => $u->is_admin); )
*/
Route::middleware(['auth', 'can:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        // CRUD des planètes (pas de page 'show' côté BO)
        Route::resource('planets', PlanetController::class)->except('show');
    });

/*
|--------------------------------------------------------------------------
| Auth (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
