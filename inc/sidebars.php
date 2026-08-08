<?php
/**
 * Travel sidebar registrations for child theme.
 *
 * @package wildtours-plugin
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * Register child-specific sidebars for travel contexts.
 *
 * This extends parent infrastructure through the parent hook only.
 */
function pwt_child_register_travel_sidebars(): void
{
    $baseArgs = [
        'before_widget' => '<section id="%1$s" class="widget pwt-widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ];

    register_sidebar([
        'name'        => __('PWT Blog Sidebar', 'wildtours-plugin'),
        'id'          => 'pwt-sidebar-blog',
        'description' => __('Widget area for blog archive and single post pages.', 'wildtours-plugin'),
    ] + $baseArgs);

    register_sidebar([
        'name'        => __('PWT Package Sidebar', 'wildtours-plugin'),
        'id'          => 'pwt-sidebar-package',
        'description' => __('Widget area for package archive and single package pages.', 'wildtours-plugin'),
    ] + $baseArgs);

    register_sidebar([
        'name'        => __('PWT Safari Sidebar', 'wildtours-plugin'),
        'id'          => 'pwt-sidebar-safari',
        'description' => __('Widget area for safari archive and single safari pages.', 'wildtours-plugin'),
    ] + $baseArgs);

    register_sidebar([
        'name'        => __('PWT Destination Sidebar', 'wildtours-plugin'),
        'id'          => 'pwt-sidebar-destination',
        'description' => __('Widget area for destination archives.', 'wildtours-plugin'),
    ] + $baseArgs);

    register_sidebar([
        'name'        => __('PWT Home Sidebar', 'wildtours-plugin'),
        'id'          => 'pwt-sidebar-home',
        'description' => __('Optional widget area for homepage travel callouts.', 'wildtours-plugin'),
    ] + $baseArgs);
}
add_action('wildtours/base/register_sidebars', 'pwt_child_register_travel_sidebars');

/**
 * Map travel content type to sidebar id.
 */
function pwt_child_travel_sidebar_for_type(string $contentType): string
{
    if ($contentType === 'pwt_package') {
        return 'pwt-sidebar-package';
    }

    if ($contentType === 'pwt_safari') {
        return 'pwt-sidebar-safari';
    }

    if ($contentType === 'pwt_destination') {
        return 'pwt-sidebar-destination';
    }

    return 'pwt-sidebar-blog';
}

/**
 * Render fallback content when a travel sidebar has no assigned widgets.
 */
function pwt_child_render_travel_sidebar_fallback(string $sidebarId): bool
{
    $travelSidebars = [
        'pwt-sidebar-package',
        'pwt-sidebar-safari',
        'pwt-sidebar-destination',
        'pwt-sidebar-home',
        'pwt-sidebar-blog',
    ];

    if (!in_array($sidebarId, $travelSidebars, true)) {
        return false;
    }

    $enabled = (bool) apply_filters('pwt_child/sidebar_fallback_enabled', true, $sidebarId);
    if (!$enabled) {
        return false;
    }

    echo '<aside class="pwt-travel-sidebar widget-area" role="complementary">';
    echo '<section class="widget pwt-widget pwt-widget-fallback">';
    echo '<h2 class="widget-title">' . esc_html__('Need Help Planning?', 'wildtours-plugin') . '</h2>';
    echo '<p>' . esc_html__('Talk to our local team for packages, safari timing, and permits.', 'wildtours-plugin') . '</p>';
    echo '<p><a class="pwt-text-link" href="' . esc_url(home_url('/contact-us/')) . '">' . esc_html__('Contact Our Team', 'wildtours-plugin') . '</a></p>';
    echo '</section>';

    if (pwt_child_is_plugin_active() && in_array($sidebarId, ['pwt-sidebar-package', 'pwt-sidebar-safari', 'pwt-sidebar-home'], true)) {
        echo '<section class="widget pwt-widget pwt-widget-fallback">';
        echo '<h2 class="widget-title">' . esc_html__('Quick Booking', 'wildtours-plugin') . '</h2>';
        echo do_shortcode('[pwt_contact_card]');
        echo '</section>';
    }

    echo '</aside>';

    return true;
}

/**
 * Render travel sidebar region when widgets are assigned.
 */
function pwt_child_render_travel_sidebar(string $sidebarId): void
{
    if ($sidebarId === '') {
        return;
    }

    if (is_active_sidebar($sidebarId)) {
        echo '<aside class="pwt-travel-sidebar widget-area" role="complementary">';
        dynamic_sidebar($sidebarId);
        echo '</aside>';

        return;
    }

    pwt_child_render_travel_sidebar_fallback($sidebarId);
}
