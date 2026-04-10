# guc.filament-theme – GUYCOLLE Design System

> Zentrales Filament Theme Package für alle GUYCOLLE Laravel-Apps.
> Einmal ändern → alle Apps übernehmen beim nächsten `composer update`.

## Projekt

**Betreiber:** GUYCOLLE GmbH
**Repo:** `git@github.com:guycollegmbh/guc.filament-theme.git` (private)
**Typ:** Composer Package (Laravel + Filament 3 Plugin)
**Konsumenten:** QualiPlus 2.0, Inventar-App, zukünftige Laravel-Apps

## Tech Stack

| Komponente | Technologie |
|-----------|-------------|
| Package-Typ | Laravel Service Provider + Filament Plugin |
| CSS | Tailwind CSS Plugin mit Custom Config |
| Font | Source Sans 3 (Google Fonts CDN) |
| Icons | Heroicons (Filament Default), Mix: Outline Nav / Solid Content |

## Design-Entscheide

| Eigenschaft | Wert |
|------------|------|
| Primary | `#00AEEF` (GUYCOLLE Blau) |
| Primary Hover | `#0090C9` |
| Primary Active | `#0077A8` |
| Primary Light | `#E8F8FE` |
| Dark / Text | `#231F20` (GUYCOLLE Dunkelgrau) |
| Gray 800 | `#3A3536` |
| Gray 500 | `#6B6566` |
| Gray 100 | `#E8E6E6` |
| Success | `#16A34A` |
| Warning | `#EAB308` |
| Danger | `#DC2626` |
| Info | `#00AEEF` (= Primary) |
| Font | Source Sans 3 (Fallback: Source Sans Pro, sans-serif) |
| Border Radius | `0px` (komplett eckig, überall) |
| Schatten | Keine – nur Borders (`1px solid`) |
| Layout | Collapsible Sidebar, dunkelgrau (`#231F20`) |
| Dark Mode | Ja, User-wählbar |
| Icons Nav | Outline (Heroicon) |
| Icons Content | Solid (Heroicon) |
| Dichte | Ausgewogen (Filament Default Spacing) |
| Buttons Primary | `#00AEEF` weiss Text |
| Buttons Secondary | `#231F20` weiss Text |
| Buttons Outline | Transparent, Border |
| Buttons Danger | `#DC2626` weiss Text |
| Tags/Badges | Eckig (0px), farbiger Hintergrund + dunklere Textfarbe |

## Verzeichnisstruktur

```
guc.filament-theme/
├── composer.json
├── src/
│   ├── GuycolleThemeServiceProvider.php   ← Laravel Service Provider
│   └── GuycolleThemePlugin.php            ← Filament Plugin (registriert Theme)
├── resources/
│   ├── css/
│   │   ├── theme.css                      ← Filament CSS Overrides
│   │   └── guycolle-standalone.css        ← Für Non-Filament Apps (guc.sharing)
│   ├── views/
│   │   └── components/                    ← Blade-Komponenten (Login, Footer)
│   └── assets/
│       ├── logo-full.svg                  ← GUYCOLLE Logo (Vollversion)
│       ├── logo-icon.svg                  ← GUYCOLLE Logo (nur Icon, für Sidebar collapsed)
│       └── favicon.svg                    ← Favicon
├── dist/
│   └── guycolle-standalone.css            ← Pre-built CSS für PHP-Apps (kein Build nötig)
├── CLAUDE.md
├── LEARNINGS.md
└── .claude/
    ├── agents/
    │   └── 01-fullstack-developer.md
    ├── rules/
    │   └── code-standards.md
    └── skills/
        └── design-system/SKILL.md         ← Kopierbar in andere Projekte!
```

## Einbindung in Laravel-Apps

### 1. composer.json der App

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:guycollegmbh/guc.filament-theme.git"
        }
    ],
    "require": {
        "guycollegmbh/filament-theme": "^1.0"
    }
}
```

### 2. PanelProvider der App

```php
use Guycolle\FilamentTheme\GuycolleThemePlugin;

$panel
    ->plugin(GuycolleThemePlugin::make())
    ->brandName('GUYCOLLE')
    ->brandLogo(asset('vendor/guycolle-theme/logo-full.svg'))
    ->brandLogoHeight('28px')
    ->favicon(asset('vendor/guycolle-theme/favicon.svg'))
    ->sidebarCollapsibleOnDesktop()
    ->darkMode(true);
```

### 3. Für Non-Filament Apps (guc.sharing)

```html
<link rel="stylesheet" href="path/to/guycolle-standalone.css">
```

## Verbotene Patterns

- ❌ Border-Radius > 0px (→ alles eckig)
- ❌ Box-Shadows (→ nur Borders)
- ❌ Andere Schrift als Source Sans 3
- ❌ Hardcoded Farben in Apps (→ CSS Variables / Filament Color Config)
- ❌ Eigene Button-Styles in Apps (→ Theme liefert alles)
- ❌ Logo als PNG einbinden (→ immer SVG)

## Release-Prozess

1. Feature-Branch mergen auf `main`
2. Auf `main` wechseln, `git pull`
3. **Smoke-Test in leerer Testapp** (siehe LEARNINGS `[2026-04]`): `composer require` via Path-Repo + `vendor:publish --tag=guycolle-theme --force` – nur wenn alle 5 Dateien (`logo-full.svg`, `logo-icon.svg`, `favicon.svg`, `theme.css`, `guycolle-standalone.css`) unter `public/vendor/guycolle-theme/` ankommen, darf getagged werden
4. Semver-Version bestimmen: Patch (Bugfix), Minor (neue Features, abwärtskompatibel), Major (Breaking)
5. Tag: `git tag -a vX.Y.Z -m "release: vX.Y.Z – <kurzbeschreibung>"`
6. Push: `git push origin vX.Y.Z`
7. GitHub Release erstellen mit Release-Notes (Fixed/Added/Changed/Migration)
8. `LEARNINGS.md` updaten falls ein Stolperstein entdeckt wurde
