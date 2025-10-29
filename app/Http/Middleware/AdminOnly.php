<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
        // Ici j’utilise Spatie\Permission (hasRole)
        if (!auth()->check() || !auth()->user()->hasRole('admin')) {
            abort(403); // ou return redirect()->route('login');
        }
        return $next($request);
    }
}
