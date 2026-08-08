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

## Sidebar fallback behavior

The child theme uses context-aware sidebars (`pwt-sidebar-*`) for blog, package, safari, destination, and homepage views.

If a contextual sidebar has no assigned widgets, the child theme can render optional fallback content (travel CTA/contact snippets) instead of leaving the area empty.

### Control the fallback with a filter

Use the `pwt_child/sidebar_fallback_enabled` filter to disable or customize this behavior per sidebar id.

```php
add_filter('pwt_child/sidebar_fallback_enabled', static function (bool $enabled, string $sidebarId): bool {
	// Example: disable fallback only for blog sidebar.
	if ($sidebarId === 'pwt-sidebar-blog') {
		return false;
	}

	return $enabled;
}, 10, 2);
```

Recommended placement: child theme `functions.php` or a site-specific mini plugin.

## Archive filter persistence

Travel archive filters are persisted across pagination in child templates.

This means when visitors select filters (for example season, package category, or safari zone), those selections are automatically kept when they move to page 2, 3, and so on.

Implementation note:

- Pagination links are generated with allowed query args from `pwt_child_current_filter_args()` in `inc/query-filters.php`.
- Templates use `pwt_child_render_filtered_pagination()` to ensure state-safe links.

