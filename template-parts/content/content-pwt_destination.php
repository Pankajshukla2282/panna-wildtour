<?php
/**
 * Child override: single PWT destination.
 *
 * Renders the destination details with a fully responsive cover image,
 * metadata chips, editor content, optional video embed, and gallery.
 *
 * @package panna-wild-tour
 */

defined('ABSPATH') || exit;

if (!function_exists('pwt_child_image_url')) {
    return;
}

while (have_posts()) : the_post();
    $destinationId = get_the_ID();
    $code = (string) get_post_meta($destinationId, 'destination_code', true);
    $state = (string) get_post_meta($destinationId, 'state', true);
    $country = (string) get_post_meta($destinationId, 'country', true);
    $bestTime = (string) get_post_meta($destinationId, 'best_time', true);
    $videoUrl = trim((string) \PWT\Frontend\Content::getField($destinationId, 'video_url'));
    $gallery = \PWT\Frontend\Content::getField($destinationId, 'gallery');
    $cover = pwt_child_image_url(\PWT\Frontend\Content::getField($destinationId, 'cover_image'));
    ?>
    <main class="pwt-single-wrap">
        <article class="pwt-single-destination">
            <?php if ($cover) : ?>
                <header class="pwt-single-hero">
                    <img src="<?php echo esc_url($cover); ?>" alt="<?php the_title_attribute(); ?>">
                </header>
            <?php elseif (has_post_thumbnail()) : ?>
                <header class="pwt-single-hero">
                    <?php the_post_thumbnail('large'); ?>
                </header>
            <?php endif; ?>

            <section class="pwt-section">
                <h1><?php the_title(); ?></h1>

                <?php if ($code || $state || $country || $bestTime) : ?>
                    <div class="pwt-meta-grid">
                        <?php if ($code) : ?><div class="pwt-meta-chip"><strong><?php esc_html_e('Code', 'panna-wild-tour'); ?>:</strong> <?php echo esc_html($code); ?></div><?php endif; ?>
                        <?php if ($state) : ?><div class="pwt-meta-chip"><strong><?php esc_html_e('State', 'panna-wild-tour'); ?>:</strong> <?php echo esc_html($state); ?></div><?php endif; ?>
                        <?php if ($country) : ?><div class="pwt-meta-chip"><strong><?php esc_html_e('Country', 'panna-wild-tour'); ?>:</strong> <?php echo esc_html($country); ?></div><?php endif; ?>
                        <?php if ($bestTime) : ?><div class="pwt-meta-chip"><strong><?php esc_html_e('Best Time', 'panna-wild-tour'); ?>:</strong> <?php echo esc_html($bestTime); ?></div><?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="pwt-destination-content">
                    <?php the_content(); ?>
                </div>

                <?php if ($videoUrl) : ?>
                    <?php echo pwt_child_render_video($videoUrl); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                <?php endif; ?>

                <?php echo pwt_child_render_gallery($gallery, get_the_title()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </section>
        </article>
    </main>
    <?php
endwhile;
