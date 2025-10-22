<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // On récupère la langue stockée en session (fr ou en)
        // Si aucune langue n’est trouvée, on utilise la langue par défaut du site
        $locale = Session::get('locale', config('app.locale'));

        // Laravel utilise cette langue pour toutes les traductions
        App::setLocale($locale);

        // On continue le chargement de la page
        return $next($request);
    }
}
