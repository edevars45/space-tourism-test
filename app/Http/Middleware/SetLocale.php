<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Langue depuis la session, sinon langue par défaut de l’app
        $locale = Session::get('locale', config('app.locale'));

        // On applique la langue à Laravel (traductions, validation, etc.)
        App::setLocale($locale);

        return $next($request);
    }
}
