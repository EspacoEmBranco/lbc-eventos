# LBC Eventos

Custom WordPress plugin to manage and display events.

## Requirements covered

- [x] Plugin registers custom post type "eventos" with title, featured image and content support
- [x] ACF fields per event: event date, location and organizer
- [x] Shortcode `[eventos_futuros]` listing events with date equal to or greater than today
- [x] Optional `limite` parameter on the shortcode to cap the number of results
- [x] 3-column responsive grid using Bootstrap 5
- [x] Single event template displaying featured image, title, date, location, organizer and content.

## Dependencies

- Advanced Custom Fields (ACF)
- WordPress 6.0+
- PHP 8.0+

## Installation

1. Place the `lbc-eventos` folder inside `wp-content/plugins/`
2. Install and activate the **Advanced Custom Fields** plugin
3. Activate **LBC Eventos** — the plugin will block activation if ACF is not active
4. Go to **ACF → Field Groups** — a **Sync available** tab will appear. Click it and then click **Import** to load the field group from the plugin's `acf-json/` folder

## Shortcode usage

```
[eventos_futuros]
```

Displays all upcoming events in a 3-column grid.

```
[eventos_futuros limite="6"]
```

Limits the output to 6 events.

## Improvements

- **ACF JSON sync** — field group definitions are version-controlled in `acf-json/` using ACF's native JSON sync. Installing the plugin on any environment exposes the field group automatically via the *Sync available* tab, removing the need to recreate fields manually.
- **Placeholder image** — events without a featured image display a CSS-only placeholder (no extra assets) in both the grid cards and the single event template, keeping the layout consistent at all times.
