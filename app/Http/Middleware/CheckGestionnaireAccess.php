<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckGestionnaireAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    //     // app/Http/Middleware/CheckGestionnaireAccess.php
    public function handle($request, Closure $next)
    {
        $user = $request->user();
    
        if ($user->role !== 'gestionnaire') {
            abort(403, 'Accès réservé aux gestionnaires');
        }

        // Restrictions spécifiques
        if ($request->is('gestionnaire/users/*')) {
            if (!in_array($request->route()->getActionMethod(), ['index', 'show'])) {
                abort(403, 'Action non autorisée');
            }
        }

        return $next($request);
    }
}
