<?php
/**
 * Child override: PWT package archive.
 *
 * @package panna-wild-tour
 */

defined('ABSPATH') || exit;

get_header();

$queriedObject = get_queried_object();
$title = post_type_archive_title('', false) ?: __('Panna Tour Packages', 'panna-wild-tour');
$actionUrl = get_post_type_archive_link('pwt_package');
$filters = [
    'package_category' => get_terms(['taxonomy' => 'pwt_package_category', 'hide_empty' => true]),
    'season' => get_terms(['taxonomy' => 'pwt_season', 'hide_empty' => true]),
];
?>
<main class="pwt-single-wrap">
    <section class="pwt-section">
        <header class="pwt-section-header">
            <h1><?php echo esc_html($title); ?></h1>
            <?php if ($queriedObject instanceof WP_Post_Type && !empty($queriedObject->description)) : ?>
                <p><?php echo esc_html($queriedObject->description); ?></p>
            <?php endif; ?>
        </header>

        <form class="pwt-filter-bar" method="get" action="<?php echo esc_url(is_string($actionUrl) ? $actionUrl : home_url('/')); ?>">
            <div class="pwt-form-grid">
                <?php foreach ($filters as $queryVar => $terms) : ?>
                    <label>
                        <span><?php echo esc_html(ucwords(str_replace('_', ' ', $queryVar))); ?></span>
                        <select name="<?php echo esc_attr($queryVar); ?>">
                            <option value=""><?php esc_html_e('All', 'panna-wild-tour'); ?></option>
                            <?php foreach ($terms as $term) : ?>
                                <option value="<?php echo esc_attr($term->slug); ?>" <?php selected(sanitize_text_field($_GET[$queryVar] ?? ''), $term->slug); ?>><?php echo esc_html($term->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                <?php endforeach; ?>
            </div>
            <p><button type="submit" class="pwt-btn"><?php esc_html_e('Apply Filters', 'panna-wild-tour'); ?></button></p>
        </form>
    </section>

    <section class="pwt-section">
        <div class="pwt-cards-grid">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article class="pwt-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="pwt-card-image"><?php the_post_thumbnail('large'); ?></div>
                        <?php endif; ?>
                        <div class="pwt-card-body">
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo esc_html(wp_trim_words(get_the_excerpt() ?: get_the_content(null, false), 24)); ?></p>
                            <a class="pwt-text-link" href="<?php the_permalink(); ?>"><?php esc_html_e('View details', 'panna-wild-tour'); ?></a>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else : ?>
                <p><?php esc_html_e('No packages found for the selected filters.', 'panna-wild-tour'); ?></p>
            <?php endif; ?>
        </div>
        <?php the_posts_pagination(); ?>
    </section>
</main>
<?php
get_footer();
