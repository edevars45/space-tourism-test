<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PlanetController;
use App\Http\Controllers\Admin\CrewMemberController;

/*
|--------------------------------------------------------------------------
| Front-office public (pages maquette)
|--------------------------------------------------------------------------
*/
Route::get('/',            fn() => view('vue.accueil'))      ->name('accueil');
Route::get('/destination', fn() => view('vue.destination'))  ->name('destination');
Route::get('/equipage',    fn() => view('vue.equipage'))     ->name('equipage');
Route::get('/technologie', fn() => view('vue.technologie'))  ->name('technologie');

/*
|--------------------------------------------------------------------------
| Changement de langue (FR / EN)
|--------------------------------------------------------------------------
*/
Route::get('lang/{locale}', function (string $locale) {
    if (in_array($locale, ['fr', 'en'], true)) {
        Session::put('locale', $locale);
    }
    return back();
})->name('lang.switch');

/*
|--------------------------------------------------------------------------
| Dashboard (Breeze)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profil (Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile',  [ProfileController::class, 'edit'])   ->name('profile.edit');
    Route::patch('/profile',[ProfileController::class, 'update']) ->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Back-office Admin (Spatie) : Planètes + Équipage
| - Accès restreint: authentifié + rôle admin
| - Permissions fines par action
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')->as('admin.')
    ->group(function () {

        // ---- Planètes ----
        Route::resource('planets', PlanetController::class)
            ->names('planets')
            ->middleware([
                'index'   => 'permission:planets.view',
                'show'    => 'permission:planets.view',   // si la route show existe
                'create'  => 'permission:planets.create',
                'store'   => 'permission:planets.create',
                'edit'    => 'permission:planets.update',
                'update'  => 'permission:planets.update',
                'destroy' => 'permission:planets.delete',
            ]);

        // ---- Équipage (Partie 5) ----
        Route::resource('crew', CrewMemberController::class)
            ->names('crew')
            ->parameters(['crew' => 'crew'])
            ->middleware([
                'index'   => 'permission:crew.view',
                'create'  => 'permission:crew.create',
                'store'   => 'permission:crew.create',
                'edit'    => 'permission:crew.update',
                'update'  => 'permission:crew.update',
                'destroy' => 'permission:crew.delete',
            ])
            ->except('show'); // pas de page publique show en back-office
    });

/*
|--------------------------------------------------------------------------
| Routes d’authentification (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
