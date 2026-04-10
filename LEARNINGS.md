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
- `[2026-04]` Release-Tags NIEMALS auf den initial commit setzen. Tag erst dann, wenn ein End-to-End Smoke-Test in einer leeren Laravel+Filament-App (via `composer require` + `vendor:publish --tag=guycolle-theme`) Logo, Favicon und theme.css nachweislich im `public/vendor/guycolle-theme/` Verzeichnis landet. v1.0.0 wurde auf `6d003e8` getagged als das Paket nur Farb-Palette und Font-Name enthielt, aber noch keine Assets, keinen renderHook und keine funktionierenden Publish-Tags. Folge: v1.0.1 Hotfix einen Tag später. _(via Fullstack Dev)_
- `[2026-04]` **Filament Sidebar-Nav-Klassen haben KEIN `-nav-`-Infix.** Korrekt ist `.fi-sidebar-item-label` / `.fi-sidebar-item-icon`, NICHT `.fi-sidebar-nav-item-label`. Der falsche Selector in v1.0.1 hat dazu geführt dass der aktive Nav-Item im Light Mode Filament-Default-Blau (#0077A8) statt GUYCOLLE-Cyan zeigte. Vor dem Schreiben eines Sidebar-Overrides IMMER im DOM der Ziel-App verifizieren welche Klassen Filament tatsächlich rendert. _(via Fullstack Dev, v1.0.2)_
- `[2026-04]` **Wenn Sidebar-BG in beiden Modi dunkel gezwungen wird (`.fi-sidebar { background-color: #231F20 }`), MÜSSEN auch alle Text- und Icon-Farben der Sidebar-Items in beiden Modi explizit hell gesetzt werden.** Filament geht im Light Mode davon aus dass die Sidebar hell ist und setzt Default-Textfarben auf dunkel – das Ergebnis ist dunkler Text auf dunklem Hintergrund (im QualiPlus-QA gemessen: 1.35:1, WCAG-Fail). Gilt für `.fi-sidebar-item-label`, `.fi-sidebar-item-icon`, `.fi-sidebar-group-label`. Analog: `.fi-sidebar-header` wird NICHT vom `.fi-sidebar`-Override erfasst und muss separat auf dunkel gezwungen werden. _(via Fullstack Dev, v1.0.2)_
- `[2026-04]` **Logo-Invert-Filter für Dark Mode gilt nicht automatisch im Sidebar-Header.** Der `filter: invert(1) hue-rotate(180deg)` Fix existierte in v1.0.1 nur für `.gc-theme-login-logo` (Login-Page). Im Sidebar-Header rendert Filament das Brand-Logo als `.fi-logo` → separate Regel `.dark .fi-sidebar-header .fi-logo` nötig. Mittelfristig sauberer: `logo-full-dark.svg` ins Package bündeln und via CSS-Image-Src wechseln statt Filter. _(via Fullstack Dev, v1.0.2)_
- `[2026-04]` **Filament Brand-Logo `<img>` hat die Klasse `.fi-logo` direkt (kein Wrapper).** Wenn `->brandLogo(string $url)` mit einem URL-String aufgerufen wird, rendert `vendor/filament/filament/resources/views/components/logo.blade.php` direkt `<img class="fi-logo" src="...">`. Das heisst CSS `content: url('/neue-url.svg')` auf `.fi-sidebar-header .fi-logo` funktioniert pixel-scharf und ersetzt den Image-Source ohne Filter-Quality-Verlust. Nur wenn `brandLogo` ein `Htmlable` (z.B. View) ist, rendert Filament einen `<div class="fi-logo">…</div>` Wrapper – dann greift `content: url()` nicht mehr. Für unser Theme stabil, weil wir Consumer-seitig immer String-URLs empfehlen. _(via Fullstack Dev, v1.1.0)_
- `[2026-04]` **Filament hat eine native `->darkModeBrandLogo($url)` API**, die bei vorhandenem Dark-Mode-Logo einen zweiten `<img>`-Tag mit Tailwind `flex dark:hidden` / `hidden dark:flex` Toggle rendert (siehe `logo.blade.php` Zeilen 5-13). Das ist der „richtige" Weg wenn der Sidebar-Header im Light Mode hell und im Dark Mode dunkel ist – bei uns aber **nicht anwendbar**, weil der Header in beiden Modi `#231F20` ist und wir deshalb IMMER die weisse Variante wollen. Deshalb CSS-basierter Swap auf `.fi-sidebar-header .fi-logo` in v1.1.0, unabhängig vom Mode. _(via Fullstack Dev, v1.1.0)_
- `[2026-04]` **Smoke-Test in leerer Laravel+Filament-App klappt nur mit Laravel 12.** `composer create-project laravel/laravel` installiert inzwischen Laravel 13, unser Theme ist aber auf `illuminate/support ^12.0` gepinnt → Install bricht ab. Workaround: `composer create-project "laravel/laravel:^12.0" smoketest`. Tech-Debt-Ticket für später: Composer-Constraint auf `^12.0|^13.0` erweitern sobald ein L13-Kompatibilitäts-Check gelaufen ist. _(via Fullstack Dev, v1.1.0)_
- `[2026-04]` **Composer Security-Audit blockt v3.2 Filament-Versionen für Smoke-Tests.** Die Advisories `PKSA-1ds2-yqqr-64g1` (filament/actions) und `PKSA-jyd3-2srm-pfqd` (filament/infolists) betreffen mittlere 3.2.x-Versionen. Für reine Publish-/Asset-Smoke-Tests im Theme-Paket (kein echter Produktivbetrieb) via `composer config --json audit.ignore '["PKSA-1ds2-yqqr-64g1","PKSA-jyd3-2srm-pfqd"]'` in der Testapp temporär ignorieren. In Produktions-Consumer-Apps (QualiPlus etc.) sollten die Patches natürlich eingespielt werden. _(via Fullstack Dev, v1.1.0)_
- `[2026-04]` **Smoke-Test für v1.1.0 bestanden:** `resources/assets/logo-full-dark.svg` + `theme.css` mit neuem CSS-Swap + `guycolle-standalone.css` + `logo-full.svg` + `logo-icon.svg` + `favicon.svg` landen nach `php artisan vendor:publish --tag=guycolle-theme --force` vollständig in `public/vendor/guycolle-theme/`. ServiceProvider musste NICHT angefasst werden, weil der bestehende Publish den kompletten `resources/assets/` Ordner als Directory glob'd – neue Dateien werden automatisch mit-publiziert. Best Practice: Assets immer directory-basiert publishen statt File-Liste, damit neue Files ohne Provider-Patch mitkommen. _(via Fullstack Dev, v1.1.0)_

---

## Update-Protokoll

- `[2026-04]` Initial-Struktur gemäss CLAUDE.md vervollständigt: `logo-full.svg` (renamed), `logo-icon.svg`, `favicon.svg`, `resources/css/guycolle-standalone.css` (Source), Blade-Components (`footer`, `login-logo`), `.claude/rules/code-standards.md` verschoben _(via Agent)_
- `[2026-04]` ServiceProvider: mehrere Publish-Tags, Standalone-CSS aus `dist/` _(via Agent)_
- `[2026-04]` Plugin: `GoogleFontProvider` für Source Sans 3 + RenderHook für theme.css _(via Agent)_
- `[2026-04]` Artefakte entfernt: leerer `guc/`-Ordner, `guc.zip` _(via Agent)_
- `[2026-04]` Inline-`<style>`-Blöcke aus Blade-Components nach `theme.css` ausgelagert (`.gc-theme-footer*`, `.gc-theme-login-*`) → alle Styles zentral, keine Inline-CSS mehr _(via Agent)_
- `[2026-04]` Font-Size-Skala proportional hochskaliert (Faktor 14/12 ≈ 1.167), kleinste Grösse ist jetzt `14px`: `12→14`, `13→15`, `14→16`, `15→18`. Betrifft `theme.css` und `guycolle-standalone.css` (+ `dist/`) _(via Agent)_
- `[2026-04]` Typography-Tokens als CSS-Variablen eingeführt (`--gc-text-xs` bis `--gc-text-2xl`) in `:root` von `guycolle-standalone.css` **und** `theme.css` (Mirror für Filament-Scope). Alle hardcoded `font-size`-Werte ersetzt. Neue Skala: 14/15/16/18/21/26/33 px _(via Agent)_
- `[2026-04]` h1/h2/h3 Base-Styles für Non-Filament-Apps ergänzt (nutzen `--gc-text-2xl/xl/lg`) _(via Agent)_
