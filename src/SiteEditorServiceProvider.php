<?php

namespace Kavi\SiteEditor;

use Illuminate\Cookie\CookieJar;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SiteEditorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->make('Kavi\SiteEditor\Http\Controllers\SiteEditorController');
        $this->loadViewsFrom(__DIR__ . '/Views', 'editor');
        $this->app['router']->aliasMiddleware('csrf', \Kavi\SiteEditor\Http\Middleware\VerifyCsrfTokenMiddleware::class);

        $this->publishes([
            __DIR__ . '/Views/siteEditor' => base_path('resources/views/vendor/siteEditor'),
        ]);

        $this->publishes([
            __DIR__ . '/assets' => public_path('Vendor/site-editor'),
        ], 'public');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::prefix('editor')->group(__DIR__.'/routes/editor.php');
    }
}
