<?php

namespace App\Providers;

use App\Http\Middleware\HtmlMinifier;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Chemin par défaut après connexion.
     */
    public const HOME = '/redirect-by-role';

    /**
     * Bootstrap des routes.
     */
    public function boot(): void
    {
         parent::boot();
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
           // Ajouter le middleware à toutes les routes 'web'
        // $this->app['router']->pushMiddlewareToGroup('web', HtmlMinifier::class);
    }
}
