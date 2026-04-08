---
name: guycolle-design-system
description: GUYCOLLE Corporate Design und UI-Richtlinien. Verwende bei
  jeder UI-Arbeit – Filament Resources, Vue-Komponenten, Blade-Views,
  CSS-Styling. Stellt sicher dass alle Apps einheitlich aussehen.
---

# GUYCOLLE Design System

## Farben

| Token | Hex | Verwendung |
|-------|-----|-----------|
| `primary` | `#00AEEF` | Primär-Buttons, aktive Nav-Items, Links, Info-Badges |
| `primary-hover` | `#0090C9` | Button-Hover |
| `primary-active` | `#0077A8` | Button-Active |
| `primary-light` | `#E8F8FE` | Info-Badge Hintergrund, leichte Highlights |
| `dark` | `#231F20` | Sidebar-Hintergrund, Sekundär-Buttons, Text |
| `gray-800` | `#3A3536` | Sekundär-Button Hover |
| `gray-500` | `#6B6566` | Labels, sekundärer Text |
| `gray-200` | `#D5D3D3` | Borders |
| `gray-100` | `#E8E6E6` | Hintergrund (leicht) |
| `success` | `#16A34A` | Erfolg-Badges, positive Status |
| `warning` | `#EAB308` | Warnung-Badges |
| `danger` | `#DC2626` | Danger-Buttons, Fehler-Badges, Löschen |

## Typografie

- **Font:** Source Sans 3 (Fallback: Source Sans Pro, sans-serif)
- **H1:** 24px, weight 600
- **H2:** 18px, weight 600
- **H3:** 15px, weight 600
- **Body:** 14px, weight 400
- **Caption/Label:** 12px, weight 400-500, Farbe gray-500

## Border-Radius

**0px. Überall. Keine Ausnahmen.**

Buttons, Cards, Inputs, Badges, Modals, Dropdowns, Tabs, Avatare – alles eckig.

## Schatten

**Keine. Nur Borders.**

Cards: `border: 1px solid gray-200`
Keine `box-shadow`, keine `drop-shadow`, keine Elevation.

## Buttons

| Typ | Hintergrund | Text | Border |
|-----|-------------|------|--------|
| Primary | `#00AEEF` | weiss | keine |
| Secondary | `#231F20` | weiss | keine |
| Outline | transparent | `#231F20` | `1px solid gray-300` |
| Danger | `#DC2626` | weiss | keine |
| Link | transparent | `#00AEEF` | keine, unterstrichen |

## Badges / Tags

Eckig (0px), farbiger Hintergrund + passende dunkle Textfarbe + 1px Border:

| Badge | Hintergrund | Text | Border |
|-------|-------------|------|--------|
| Success | `#DCFCE7` | `#166534` | `#BBF7D0` |
| Danger | `#FEE2E2` | `#991B1B` | `#FECACA` |
| Warning | `#FEF9C3` | `#854D0E` | `#FDE68A` |
| Info | `#E8F8FE` | `#0077A8` | `#B3E8FC` |
| Neutral | `#E8E6E6` | `#3A3536` | `#D5D3D3` |

## Layout

- **Sidebar:** Collapsible, Hintergrund `#231F20`
- **Aktiver Nav-Item:** Text `#00AEEF`, Hintergrund `rgba(0,174,239,0.08)`
- **Inaktiver Nav-Item:** Text `rgba(255,255,255,0.5)`
- **Icons Navigation:** Outline-Stil (Heroicons Outline)
- **Icons Content:** Solid-Stil (Heroicons Solid)
- **Dichte:** Ausgewogen (Standard Filament Spacing)

## Dark Mode

User-wählbar. Alle Farben via CSS Variables / Filament Color Config.
Sidebar bleibt dunkelgrau in beiden Modi.

## Logo

- **Vollversion:** `logo-full.svg` (für Header expanded)
- **Icon:** `logo-icon.svg` (für Sidebar collapsed)
- **Favicon:** `favicon.svg`
- Immer SVG, nie PNG

## Schweizer Formatierung

- Zahlen: Apostroph als Tausendertrennzeichen (`2'499.00`)
- Datum: `dd.mm.yyyy` (z.B. `15.03.2025`)
- Dezimalpunkt (nicht Komma)
- Währung: `CHF` vor dem Betrag

## Filament-spezifisch

Package einbinden:
```php
$panel->plugin(GuycolleThemePlugin::make());
```

Das Plugin konfiguriert automatisch: Farben, Font, Sidebar, Dark Mode.
CSS-Override (`theme.css`) entfernt Border-Radius und Schatten.
