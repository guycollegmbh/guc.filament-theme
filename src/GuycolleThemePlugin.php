<?php

declare(strict_types=1);

namespace Guycolle\FilamentTheme;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;

class GuycolleThemePlugin implements Plugin
{
    public static function make(): static
    {
        return new static();
    }

    public function getId(): string
    {
        return 'guycolle-theme';
    }

    public function register(Panel $panel): void
    {
        $panel
            // Farben
            ->colors([
                'primary' => [
                    50 => '#E8F8FE',
                    100 => '#C5EEFB',
                    200 => '#8EDDF7',
                    300 => '#4DC8F0',
                    400 => '#00AEEF',  // GUYCOLLE Blau
                    500 => '#0090C9',
                    600 => '#0077A8',
                    700 => '#005E87',
                    800 => '#004566',
                    900 => '#002C45',
                    950 => '#001A2B',
                ],
                'gray' => [
                    50 => '#F5F4F4',
                    100 => '#E8E6E6',
                    200 => '#D5D3D3',
                    300 => '#B5B2B2',
                    400 => '#8E8A8A',
                    500 => '#6B6566',
                    600 => '#534E4F',
                    700 => '#3A3536',
                    800 => '#2E2A2B',
                    900 => '#231F20',  // GUYCOLLE Dunkelgrau
                    950 => '#171415',
                ],
                'danger' => Color::Red,
                'success' => Color::Green,
                'warning' => Color::Amber,
                'info' => [
                    50 => '#E8F8FE',
                    100 => '#C5EEFB',
                    200 => '#8EDDF7',
                    300 => '#4DC8F0',
                    400 => '#00AEEF',
                    500 => '#0090C9',
                    600 => '#0077A8',
                    700 => '#005E87',
                    800 => '#004566',
                    900 => '#002C45',
                    950 => '#001A2B',
                ],
            ])

            // Layout
            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth(MaxWidth::Full)

            // Dark Mode
            ->darkMode(true)

            // Font
            ->font('Source Sans 3');
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
