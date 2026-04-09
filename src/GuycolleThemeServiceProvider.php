<?php

declare(strict_types=1);

namespace Guycolle\FilamentTheme;

use Illuminate\Support\ServiceProvider;

class GuycolleThemeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'guycolle-theme');

        // Publish assets (logos, favicon) – SVG only, no PNG
        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('vendor/guycolle-theme'),
        ], 'guycolle-theme-assets');

        // Publish Filament theme CSS overrides (to be imported in app's theme)
        $this->publishes([
            __DIR__ . '/../resources/css/theme.css' => public_path('vendor/guycolle-theme/theme.css'),
        ], 'guycolle-theme-css');

        // Publish pre-built standalone CSS (no build-step required, for Non-Filament apps)
        $this->publishes([
            __DIR__ . '/../dist/guycolle-standalone.css' => public_path('vendor/guycolle-theme/guycolle-standalone.css'),
        ], 'guycolle-theme-standalone');

        // Publish all assets at once
        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('vendor/guycolle-theme'),
            __DIR__ . '/../resources/css/theme.css' => public_path('vendor/guycolle-theme/theme.css'),
            __DIR__ . '/../dist/guycolle-standalone.css' => public_path('vendor/guycolle-theme/guycolle-standalone.css'),
        ], 'guycolle-theme');

        // Publish Blade views for override
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/guycolle-theme'),
        ], 'guycolle-theme-views');
    }

    public function register(): void
    {
        //
    }
}
