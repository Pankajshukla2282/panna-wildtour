# Panna Wild Tours Child Theme

This child theme extends wildtours-base-theme and is aligned to work with the wildtours-plugin plugin.

## Purpose

- Keep parent theme updates safe while applying Panna-specific branding and template overrides.
- Reuse plugin text domain and naming conventions (`wildtours-plugin`, `pwt_*`).

## Current child-theme setup

- Parent theme template: `wildtours-base-theme`
- Child bootstrap: `functions.php`
- Child fallback template: `index.php`
- Child global configuration: `theme.json`

The installed parent theme folder must also be named `wildtours-base-theme`.
If the parent zip is packaged with a different folder name such as `wildtours-base-theme-fresh` or `wildtours-base-theme-Development`, WordPress will mark this child theme as broken because the `Template` header no longer matches the installed parent slug.

## Optional override assets

If present, these files are automatically loaded by the child theme:

- `assets/css/frontend.css`
- `assets/js/frontend.js`

## Plugin alignment

- Plugin slug: `wildtours-plugin`
- Plugin text domain: `wildtours-plugin`
- Common plugin post types: `pwt_package`, `pwt_safari`, `pwt_destination`, `pwt_booking`

Use child template overrides (for example, custom archive/single templates) only when you need presentation changes on top of plugin output.

