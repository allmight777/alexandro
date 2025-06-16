<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GestionnaireMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est connecté
        if (!auth()->check()) {
            return redirect('/login'); // ou la route de connexion
        }

        // Vérifie si l'utilisateur a le rôle gestionnaire ou admin
        $user = auth()->user();

        if ($user->role !== 'gestionnaire' && $user->role !== 'admin') {
            abort(403, 'Accès interdit'); // interdiction d'accès
        }

        return $next($request);
    }
}
