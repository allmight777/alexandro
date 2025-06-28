<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->role !== $role) {
            abort(403, 'Accès refusé');
        }

        return $next($request);
    }
}
dd([
    'user_id' => Auth::id(),
    'role_utilisateur' => Auth::user()->role,
    'role_attendu' => $role,
]);
