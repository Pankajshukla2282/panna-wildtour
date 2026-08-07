# Panna Wild Tours Child Theme

This child theme extends wildtours-base-theme and is aligned to work with the panna-wild-tour plugin.

## Purpose

- Keep parent theme updates safe while applying Panna-specific branding and template overrides.
- Reuse plugin text domain and naming conventions (`panna-wild-tour`, `pwt_*`).

## Current child-theme setup

- Parent theme template: `wildtours-base-theme`
- Child bootstrap: `functions.php`
- Child fallback template: `index.php`
- Child global configuration: `theme.json`

## Optional override assets

If present, these files are automatically loaded by the child theme:

- `assets/css/frontend.css`
- `assets/js/frontend.js`

## Plugin alignment

- Plugin slug: `panna-wild-tour`
- Plugin text domain: `panna-wild-tour`
- Common plugin post types: `pwt_package`, `pwt_safari`, `pwt_destination`, `pwt_booking`

Use child template overrides (for example, custom archive/single templates) only when you need presentation changes on top of plugin output.

