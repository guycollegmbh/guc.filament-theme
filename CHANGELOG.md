# Changelog

Alle notable Änderungen an `guycollegmbh/filament-theme` werden in dieser Datei dokumentiert.
Das Format folgt [Keep a Changelog](https://keepachangelog.com/de/1.1.0/),
das Paket nutzt [Semantic Versioning](https://semver.org/lang/de/).

---

## [1.1.0] – 2026-04-10

### Added
- **`resources/assets/logo-full-dark.svg`** – dedizierte Logo-Variante für dunkle Hintergründe. Identische Geometrie wie `logo-full.svg`, aber die 7 Pfade mit `fill:rgb(35,31,32)` (GUY-Schriftzug + 4 Deko-Rects) sind auf `fill:rgb(255,255,255)` getauscht. Die "COLLE"-Pfade und das kleine Quadrat bleiben Cyan (`rgb(0,174,239)`). Wird automatisch via `--tag=guycolle-theme` und `--tag=guycolle-theme-assets` mit-publiziert (der ServiceProvider globbed den kompletten Assets-Ordner).

### Changed
- **Sidebar-Header Logo nutzt jetzt `logo-full-dark.svg`** (pixel-scharf, kein Filter) statt dem v1.0.2 `filter: invert(1) hue-rotate(180deg)` Hack. Umsetzung in `theme.css` via CSS `content: url('/vendor/guycolle-theme/logo-full-dark.svg')` auf `.fi-sidebar-header .fi-logo`. Funktioniert in beiden Modi, weil der Sidebar-Header seit v1.0.2 durchgängig auf `#231F20` fixiert ist.

### Removed
- v1.0.2 `.dark .fi-sidebar-header .fi-logo { filter: invert(1) hue-rotate(180deg); }` – wird durch die saubere SVG-Swap-Lösung überflüssig.

### Fixed
- **S-01** (aus QualiPlus 2.0 QA Walkthrough #70 Runde 2) – Im Light Mode war nach dem v1.0.2 Sidebar-Header-BG-Fix nur noch der cyane "COLLE"-Teil des Logos sichtbar. Die 7 dunklen Pfade verschmolzen mit dem nun ebenfalls dunklen Header-BG (`#231F20`). Ist mit v1.1.0 behoben: das komplette Logo (GUY + COLLE + alle Deko-Elemente) ist in beiden Modi sichtbar.

### Migration
Keine Breaking Changes. Consumer-Apps:

```bash
composer update guycollegmbh/filament-theme
php artisan vendor:publish --tag=guycolle-theme --force
```

Panel-Provider bleibt unverändert – `->brandLogo(asset('vendor/guycolle-theme/logo-full.svg'))` ist weiterhin korrekt. Der Swap auf die dunkle Variante passiert ausschliesslich im Sidebar-Header via CSS. In anderen Kontexten (Login-Page, Topbar mobil, etc.) wird weiterhin das Original-Logo verwendet.

### Known Limitations
- Der Login-Logo-Invert-Filter (`.gc-theme-login-logo` im Dark Mode) wurde bewusst **nicht** mit-migriert. Die Login-Page nutzt das eigene Component-Markup (`<x-guycolle-theme::login-logo />`), nicht Filaments `brandLogo`. Wird in einer späteren Version adressiert.

---

## [1.0.2] – 2026-04-10

### Fixed
Behebt 5 Findings aus dem QualiPlus 2.0 QA-Walkthrough (Issue [guycollegmbh/guc.qualiplus-2.0#70](https://github.com/guycollegmbh/guc.qualiplus-2.0/issues/70)). Alle Kontraste mit der WCAG-2.1-Formel gegen Sidebar-Background `#231F20` gemessen.

- **F-01** 🔴 Light-Mode inaktive Sidebar-Nav-Items waren unlesbar (Kontrast 1.35:1 → nun ≥ 7:1). `.fi-sidebar-item-label` und `.fi-sidebar-item-icon` explizit auf `#D5D3D3` / `#8E8A8A` gesetzt.
- **F-02** 🔴 Light-Mode Group-Labels (`.fi-sidebar-group-label`) waren praktisch unsichtbar (2.86:1 → ≥ 4.5:1).
- **F-03** 🟠 Active-Nav-Selector war falsch: Filament rendert `.fi-sidebar-item-label`, nicht `.fi-sidebar-nav-item-label`. Selector korrigiert → `#00AEEF`.
- **F-04** 🟠 Light-Mode: `.fi-sidebar-header` blieb weiss während der Rest der Sidebar dunkel war → jetzt in beiden Modi auf `#231F20` gezwungen.
- **F-05** 🟠 Dark-Mode: Sidebar-Logo verschmolz mit dem Header-Background. Als Interimslösung Invert-Filter analog zu `.gc-theme-login-logo` gesetzt. (In v1.1.0 durch saubere SVG-Variante ersetzt.)

---

## [1.0.1] – 2026-04

### Added
- Build-free Theme-Loading via `renderHook('panels::head.end', ...)` als `<link>`-Tag
- Typography-Tokens als CSS-Variablen (`--gc-text-xs` bis `--gc-text-2xl`), Skala 14/15/16/18/21/26/33 px
- Inline-Component-Styles aus Blade nach `theme.css` ausgelagert
- Publish-Tags: `guycolle-theme` (alles), `-assets`, `-css`, `-standalone`, `-views`

---

## [1.0.0] – 2026-04

### Added
- Initiale Version mit GUYCOLLE-Farb-Palette, Source Sans 3 Font-Setup, Filament Plugin + ServiceProvider
- **Achtung:** Dieser Release war verfrüht getagged und enthielt weder Assets noch renderHook. Durch v1.0.1 Hotfix einen Tag später ersetzt. Nicht für den produktiven Einsatz geeignet.
