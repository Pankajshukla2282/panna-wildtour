<?php
/**
 * Panna Wild Tours child theme bootstrap.
 *
 * @package panna-wild-tour
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$pwtChildBlockFeatures = get_stylesheet_directory() . '/inc/block-features.php';
if (file_exists($pwtChildBlockFeatures)) {
    require_once $pwtChildBlockFeatures;
}

/**
 * Detect whether the Panna Wild Tour plugin is active.
 */
function pwt_child_is_plugin_active(): bool
{
    return defined('PWT_PLUGIN_FILE') || class_exists('PWT\\Core\\Plugin');
}

/**
 * Absolute path to the plugin template directory.
 */
function pwt_child_plugin_templates_path(): string
{
    return WP_PLUGIN_DIR . '/panna-wild-tour/public/templates/';
}

/**
 * Safely resolve a plugin template file path.
 */
function pwt_child_plugin_template_file(string $filename): string
{
    $path = pwt_child_plugin_templates_path() . ltrim($filename, '/');

    return file_exists($path) ? $path : '';
}

/**
 * Resolve a child-theme override template if provided.
 */
function pwt_child_locate_override_template(string $relativePath): string
{
    $path = get_stylesheet_directory() . '/' . ltrim($relativePath, '/');

    return file_exists($path) ? $path : '';
}

/**
 * Resolve a media field value (ACF/SCF/meta) to an image URL.
 *
 * Handles arrays with 'url'/'id', numeric attachment IDs, and raw URLs.
 */
function pwt_child_image_url($image, string $size = 'large'): string
{
    if (empty($image)) {
        return '';
    }

    if (is_array($image)) {
        if (!empty($image['url'])) {
            return (string) $image['url'];
        }

        if (!empty($image['id'])) {
            $url = wp_get_attachment_image_url((int) $image['id'], $size);
            return $url ?: '';
        }

        if (!empty($image['ID'])) {
            $url = wp_get_attachment_image_url((int) $image['ID'], $size);
            return $url ?: '';
        }

        return '';
    }

    if (is_numeric($image)) {
        $url = wp_get_attachment_image_url((int) $image, $size);
        return $url ?: '';
    }

    if (is_string($image) && trim($image) !== '') {
        return trim($image);
    }

    return '';
}

/**
 * Render a responsive video from a URL.
 *
 * Native video files (mp4/webm/ogg/mov) are rendered with the <video> element;
 * anything oEmbed-able (YouTube, Vimeo, ...) is rendered as a fluid 16:9 frame.
 */
function pwt_child_render_video(string $url): string
{
    $url = trim($url);

    if ($url === '') {
        return '';
    }

    $isNative = (bool) preg_match('/\.(mp4|webm|ogv|ogg|mov)(\?|#|$)/i', $url);

    if ($isNative) {
        return '<div class="pwt-video pwt-video-native">'
            . '<video controls playsinline preload="metadata" src="' . esc_url($url) . '"></video>'
            . '</div>';
    }

    $oembed = wp_oembed_get($url);

    if ($oembed !== false) {
        return '<div class="pwt-video pwt-video-frame">' . $oembed . '</div>';
    }

    return '';
}

/**
 * Normalize a gallery field value into a list of image URLs.
 */
function pwt_child_gallery_urls($gallery): array
{
    if (empty($gallery)) {
        return [];
    }

    if (is_string($gallery)) {
        $gallery = trim($gallery);

        if ($gallery === '') {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $gallery))));
    }

    if (!is_array($gallery)) {
        return [];
    }

    $urls = [];

    foreach ($gallery as $item) {
        if (is_array($item)) {
            if (!empty($item['url'])) {
                $urls[] = (string) $item['url'];
            } elseif (!empty($item['id'])) {
                $url = wp_get_attachment_image_url((int) $item['id'], 'large');
                if ($url) {
                    $urls[] = $url;
                }
            }
        } elseif (is_numeric($item)) {
            $url = wp_get_attachment_image_url((int) $item, 'large');
            if ($url) {
                $urls[] = $url;
            }
        } elseif (is_string($item) && trim($item) !== '') {
            $urls[] = trim($item);
        }
    }

    return array_values(array_filter($urls));
}

/**
 * Render a responsive gallery grid from a gallery field value.
 */
function pwt_child_render_gallery($gallery, string $alt = ''): string
{
    $urls = pwt_child_gallery_urls($gallery);

    if (!$urls) {
        return '';
    }

    $alt = $alt !== '' ? $alt : get_bloginfo('name');

    $output = '<div class="pwt-gallery-grid">';

    foreach ($urls as $url) {
        $output .= '<img loading="lazy" src="' . esc_url($url) . '" alt="' . esc_attr($alt) . '">';
    }

    $output .= '</div>';

    return $output;
}

/**
 * Detect whether current query is for a PWT taxonomy.
 */
function pwt_child_is_pwt_taxonomy_view(): bool
{
    if (!is_tax()) {
        return false;
    }

    $queriedObject = get_queried_object();

    return $queriedObject instanceof WP_Term
        && str_starts_with($queriedObject->taxonomy, 'pwt_');
}

/**
 * Route plugin content to child/plugin templates.
 */
function pwt_child_resolve_template(string $template): string
{
    if (!pwt_child_is_plugin_active()) {
        return $template;
    }

    $postType = get_post_type() ?: '';

    if (is_singular('pwt_package')) {
        $override = pwt_child_locate_override_template('template-parts/pwt/single-package.php');
        if ($override !== '') {
            return $override;
        }

        $pluginTemplate = pwt_child_plugin_template_file('single-package.php');
        return $pluginTemplate !== '' ? $pluginTemplate : $template;
    }

    if (is_singular('pwt_safari')) {
        $override = pwt_child_locate_override_template('template-parts/pwt/single-safari.php');
        if ($override !== '') {
            return $override;
        }

        $pluginTemplate = pwt_child_plugin_template_file('single-safari.php');
        return $pluginTemplate !== '' ? $pluginTemplate : $template;
    }

    if (is_post_type_archive() && str_starts_with($postType, 'pwt_')) {
        $archiveSpecific = pwt_child_locate_override_template('template-parts/pwt/archive-' . $postType . '.php');
        if ($archiveSpecific !== '') {
            return $archiveSpecific;
        }

        $archiveGeneric = pwt_child_locate_override_template('template-parts/pwt/archive-listing.php');
        if ($archiveGeneric !== '') {
            return $archiveGeneric;
        }

        $pluginTemplate = pwt_child_plugin_template_file('archive-listing.php');
        return $pluginTemplate !== '' ? $pluginTemplate : $template;
    }

    if (pwt_child_is_pwt_taxonomy_view()) {
        $archiveGeneric = pwt_child_locate_override_template('template-parts/pwt/archive-listing.php');
        if ($archiveGeneric !== '') {
            return $archiveGeneric;
        }

        $pluginTemplate = pwt_child_plugin_template_file('archive-listing.php');
        return $pluginTemplate !== '' ? $pluginTemplate : $template;
    }

    return $template;
}

add_action('after_setup_theme', static function (): void {
    load_child_theme_textdomain('panna-wild-tour', get_stylesheet_directory() . '/languages');

    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
});

add_action('wp_enqueue_scripts', static function (): void {
    $theme = wp_get_theme();

    // Parent theme style handle is registered by wildtours-base-theme.
    wp_enqueue_style(
        'pwt-child-style',
        get_stylesheet_uri(),
        ['wildtours-base'],
        (string) $theme->get('Version')
    );

    $childFrontendCss = get_stylesheet_directory() . '/assets/css/frontend.css';
    if (file_exists($childFrontendCss)) {
        wp_enqueue_style(
            'pwt-child-frontend',
            get_stylesheet_directory_uri() . '/assets/css/frontend.css',
            ['pwt-child-style'],
            (string) filemtime($childFrontendCss)
        );
    }

    $childFrontendJs = get_stylesheet_directory() . '/assets/js/frontend.js';
    if (file_exists($childFrontendJs)) {
        wp_enqueue_script(
            'pwt-child-frontend',
            get_stylesheet_directory_uri() . '/assets/js/frontend.js',
            ['wildtours-base'],
            (string) filemtime($childFrontendJs),
            true
        );
    }
});

add_filter('pwt/template', 'pwt_child_resolve_template', 20);

add_action('pre_get_posts', static function (WP_Query $query): void {
    if (is_admin() || !$query->is_main_query() || !$query->is_search()) {
        return;
    }

    $postType = $query->get('post_type');
    if (!empty($postType) && $postType !== 'any') {
        return;
    }

    $query->set('post_type', [
        'post',
        'page',
        'pwt_package',
        'pwt_safari',
        'pwt_destination',
        'pwt_resort',
    ]);
});

add_filter('body_class', static function (array $classes): array {
    if (pwt_child_is_plugin_active()) {
        $classes[] = 'pwt-plugin-active';
    }

    $postType = get_post_type();
    if (is_string($postType) && str_starts_with($postType, 'pwt_')) {
        $classes[] = 'pwt-content-view';
    }

    if (pwt_child_is_pwt_taxonomy_view()) {
        $classes[] = 'pwt-taxonomy-view';
    }

    return $classes;
});
