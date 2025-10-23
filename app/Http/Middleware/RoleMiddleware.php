<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Vérifie que l'utilisateur connecté possède AU MOINS un des rôles passés
     * Exemples d’usage : 'role:admin' ou 'role:admin,manager'
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Pas connecté -> Laravel redirigera déjà via 'auth', mais on sécurise.
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // On suppose une colonne 'role' (string) sur la table users
        $userRole = $user->role ?? null;

        // Si l'utilisateur n'a pas un rôle autorisé -> 403
        if (!$userRole || !in_array($userRole, $roles, true)) {
            abort(403, 'Accès réservé.');
        }

        return $next($request);
    }
}
