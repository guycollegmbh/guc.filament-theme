# LEARNINGS – guc.filament-theme

> Erkenntnisse zum Theme Package.

---

## Filament Overrides

- `[2026-04]` Theme-CSS ohne Build-Step → via `renderHook('panels::head.end', ...)` als `<link>`-Tag einbinden, kein Vite nötig _(via Agent)_
- `[2026-04]` Font Source Sans 3 wird via `GoogleFontProvider` geladen → Filament rendert automatisch `<link>` zu Google Fonts CDN _(via Agent)_

---

## Projekt-spezifisch

- `[2026-04]` Border-Radius 0px muss per `!important` erzwungen werden weil Filament inline-styles nutzt _(via Projektleiter)_
- `[2026-04]` Sidebar-Farbe kann nicht via Filament Color Config gesetzt werden → CSS Override nötig _(via Projektleiter)_
- `[2026-04]` Publish-Tags: `guycolle-theme` (alles) | `guycolle-theme-assets` (nur SVGs) | `guycolle-theme-css` (nur theme.css) | `guycolle-theme-standalone` (standalone.css) | `guycolle-theme-views` (Blade) _(via Agent)_
- `[2026-04]` Assets werden nach `public/vendor/guycolle-theme/` publiziert → App muss `php artisan vendor:publish --tag=guycolle-theme` nach jedem `composer update` ausführen _(via Agent)_

---

## Update-Protokoll

- `[2026-04]` Initial-Struktur gemäss CLAUDE.md vervollständigt: `logo-full.svg` (renamed), `logo-icon.svg`, `favicon.svg`, `resources/css/guycolle-standalone.css` (Source), Blade-Components (`footer`, `login-logo`), `.claude/rules/code-standards.md` verschoben _(via Agent)_
- `[2026-04]` ServiceProvider: mehrere Publish-Tags, Standalone-CSS aus `dist/` _(via Agent)_
- `[2026-04]` Plugin: `GoogleFontProvider` für Source Sans 3 + RenderHook für theme.css _(via Agent)_
- `[2026-04]` Artefakte entfernt: leerer `guc/`-Ordner, `guc.zip` _(via Agent)_
- `[2026-04]` Inline-`<style>`-Blöcke aus Blade-Components nach `theme.css` ausgelagert (`.gc-theme-footer*`, `.gc-theme-login-*`) → alle Styles zentral, keine Inline-CSS mehr _(via Agent)_
- `[2026-04]` Font-Size-Skala proportional hochskaliert (Faktor 14/12 ≈ 1.167), kleinste Grösse ist jetzt `14px`: `12→14`, `13→15`, `14→16`, `15→18`. Betrifft `theme.css` und `guycolle-standalone.css` (+ `dist/`) _(via Agent)_
