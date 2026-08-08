<?php
/**
 * Archive pagination helpers for preserving filter state.
 *
 * @package wildtours-plugin
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * Build add_args from a whitelist of query vars.
 *
 * @param array<int,string> $allowedKeys
 * @return array<string,string>
 */
function pwt_child_collect_filter_args(array $allowedKeys): array
{
    $args = [];

    foreach ($allowedKeys as $key) {
        $value = sanitize_text_field((string) ($_GET[$key] ?? ''));

        if ($value !== '') {
            $args[$key] = $value;
        }
    }

    return $args;
}

/**
 * Render archive pagination while preserving selected filters.
 *
 * @param array<int,string> $allowedKeys
 */
function pwt_child_render_archive_pagination(array $allowedKeys): void
{
    the_posts_pagination([
        'add_args' => pwt_child_collect_filter_args($allowedKeys),
    ]);
}
