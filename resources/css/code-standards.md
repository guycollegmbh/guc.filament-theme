# Code-Standards – guc.filament-theme

## PHP
- `declare(strict_types=1)` überall
- PSR-4 Autoloading: `Guycolle\FilamentTheme\`
- Filament Plugin Interface implementieren
- Laravel Service Provider für Asset-Publishing

## CSS
- Pures CSS, kein Sass/PostCSS
- CSS Custom Properties für alle Farben
- `!important` nur wo nötig für Filament-Overrides
- Kommentare mit Sektions-Header für Lesbarkeit

## Assets
- Logos: SVG, nie PNG
- Keine externen CDN-Abhängigkeiten im Package selbst
- Google Fonts Einbindung in der konsumierenden App (Filament `->font()`)

## Git
- Semantic Versioning (1.0.0, 1.1.0, etc.)
- Tags für Releases: `v1.0.0`
- Conventional Commits
