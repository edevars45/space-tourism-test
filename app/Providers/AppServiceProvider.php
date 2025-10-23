<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * J’enregistre ici, si besoin, des services applicatifs.
     */
    public function register(): void
    {
        // Rien à enregistrer pour la partie 04.
    }

    /**
     * Au démarrage, je déclare le Gate "admin".
     * Je décide qu’un utilisateur est admin si sa colonne users.role vaut 'admin'.
     * Cela me permet d’utiliser le middleware natif 'can:admin' dans mes routes.
     */
    public function boot(): void
    {
        Gate::define('admin', function ($user) {
            return ($user->role ?? 'user') === 'admin';
        });
    }
}
