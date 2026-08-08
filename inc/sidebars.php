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
