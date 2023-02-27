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
        $this->loadViewsFrom(__DIR__.'/Views', 'editor');
        $this->app['router']->aliasMiddleware('csrf', \Kavi\SiteEditor\Http\Middleware\VerifyCsrfTokenMiddleware::class);

        $this->publishes([
            __DIR__.'/Http/Controllers/SiteEditorController.php' => app_path('Http/Controllers/Vendor/SiteEditorController.php'),
            __DIR__.'/Views/siteEditor' => base_path('resources/views/vendor/siteEditor'),
            // __DIR__.'/config/csrf.php' => config_path('csrf.php'),
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::prefix('editor')->group(__DIR__.'/routes/editor.php');
    }
}
