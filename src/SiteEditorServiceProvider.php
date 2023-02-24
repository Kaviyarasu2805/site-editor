<?php

namespace Kavi\SiteEditor;

use Illuminate\Cookie\CookieJar;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class SiteEditorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->make('Kavi\SiteEditor\Http\Controllers\SiteEditorController');
        $this->loadViewsFrom(__DIR__.'/Views', 'editor');
        $this->app['router']->aliasMiddleware('csrf', \Kavi\SiteEditor\Http\Middleware\VerifyCsrfTokenMiddleware::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::prefix('site-editor')
                ->group(base_path('routes/editor.php'));
        });

        $this->publishes([
            __DIR__.'/config/csrf.php' => config_path('csrf.php'),
        ], 'config');
    }

    protected function bootForConsole()
    {
        $this->publishes([
            __DIR__.'/Http/Controllers/SiteEditorController.php' => app_path('app/Http/Controllers/Vendor/SiteEditorController.php'),
        ]);

        $this->publishes([
            __DIR__.'/Views/siteEditor' => base_path('resources/views/vendor/siteEditor'),
        ]);

    }
}
