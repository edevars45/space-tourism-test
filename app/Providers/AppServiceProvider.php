<?php

namespace App\Providers;

use App\Models\User;                 //  IMPORT DU MODELE USER
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Enregistrer des services applicatifs (si besoin).
     */
    public function register(): void
    {
        // Rien à enregistrer pour l’instant.
    }

    /**
     * Déclarer les Gates/Policies.
     */
    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            // UNE logique et laisse les autres en commentaire.

            //  Spatie\Permission (recommandé si tu as HasRoles sur User)
            return $user->hasRole('admin');

            // OU avec une colonne booléenne en base
            // return (bool) $user->is_admin;

            // OU avec une colonne texte 'role'
            // return $user->role === 'admin';
        });
    }
}
