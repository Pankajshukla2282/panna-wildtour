<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('after_setup_theme', function () {
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_theme_support('align-wide');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
});

add_action('wp_enqueue_scripts', function () {
    $version = wp_get_theme()->get('Version');

    wp_enqueue_style(
        'panna-global',
        get_theme_file_uri('/assets/css/global.css'),
        [],
        $version
    );

    wp_enqueue_style(
        'panna-header',
        get_theme_file_uri('/assets/css/header.css'),
        ['panna-global'],
        $version
    );

    wp_enqueue_script(
        'panna-header',
        get_theme_file_uri('/assets/js/header.js'),
        [],
        $version,
        true
    );
});

add_action('init', function () {
    $patterns = [
        'hero',
        'booking-cta',
        'featured-packages',
        'why-us',
        'explore-panna',
        'resorts',
        'gallery',
        'testimonials',
        'faq',
        'blog',
        'newsletter',
        'contact',
        'footer-cta',
    ];

    foreach ($patterns as $pattern) {
        register_block_pattern(
            'panna/' . $pattern,
            require get_theme_file_path("/patterns/{$pattern}.php")
        );
    }
});

