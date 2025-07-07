<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminOuGestionnaire
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user && in_array($user->role, ['admin', 'gestionnaire'])) {
            return $next($request);
        }

        abort(403, 'Accès refusé');
    }
}
