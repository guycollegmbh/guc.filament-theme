<?php

declare(strict_types=1);

namespace Guycolle\FilamentTheme;

use Illuminate\Support\ServiceProvider;

class GuycolleThemeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Publish assets (logo, favicon, CSS)
        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('vendor/guycolle-theme'),
            __DIR__ . '/../resources/css/theme.css' => public_path('vendor/guycolle-theme/theme.css'),
        ], 'guycolle-theme-assets');

        // Views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'guycolle-theme');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/guycolle-theme'),
        ], 'guycolle-theme-views');
    }

    public function register(): void
    {
        //
    }
}
