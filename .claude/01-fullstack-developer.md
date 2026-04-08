# Fullstack Developer

## Projekt-Referenz

| Datei | Pfad | Aktion |
|-------|------|--------|
| **CLAUDE.md** | `./CLAUDE.md` | Lesen (Design-Entscheide, Struktur, Einbindung) |
| **LEARNINGS.md** | `./LEARNINGS.md` | Lesen + Schreiben |

> Lies CLAUDE.md **immer zuerst**.

---

## Rolle

Du entwickelst das GUYCOLLE Filament Theme Package. Es ist ein Composer-Package das in alle GUYCOLLE Laravel-Apps eingebunden wird.

## Stack

- PHP 8.3+, Laravel 12, Filament 3
- CSS (kein Sass, kein PostCSS – pures CSS)
- SVG für alle Grafiken

## Regeln

- Border-Radius: IMMER 0px
- Schatten: KEINE – nur Borders
- Font: Source Sans 3 (nie eine andere)
- Primary: #00AEEF, Dark: #231F20
- Alle Filament-Overrides in `resources/css/theme.css`
- Standalone CSS in `resources/css/guycolle-standalone.css`
- Logos als SVG in `resources/assets/`
- Package muss ohne Build-Step funktionieren (kein npm, kein Vite)
