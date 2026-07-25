<?php
/**
 * Attractions page template
 *
 * @package Panna_Wild_Tour
 */

get_header();
?>
<main id="content" class="site-main site-wrapper page-attractions">
    <section class="section">
        <div class="section-header">
            <h1><?php esc_html_e( 'Attractions Around Panna', 'panna-wildtour' ); ?></h1>
            <p><?php esc_html_e( 'Panna combines wildlife, river landscapes, and heritage circuits, making it ideal for both short and extended nature trips.', 'panna-wildtour' ); ?></p>
        </div>

        <div class="entry-content page-intro-content">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        </div>

        <div class="attraction-list">
            <article>
                <h3><?php esc_html_e( 'Panna Tiger Reserve', 'panna-wildtour' ); ?></h3>
                <p><?php esc_html_e( 'The region’s flagship attraction with rich biodiversity and multiple safari routes known for tiger, leopard, and birdlife activity.', 'panna-wildtour' ); ?></p>
            </article>

            <article>
                <h3><?php esc_html_e( 'Ken River Corridor', 'panna-wildtour' ); ?></h3>
                <p><?php esc_html_e( 'A scenic ecosystem passing through forest terrain, ideal for landscape viewing and wildlife movement observation.', 'panna-wildtour' ); ?></p>
            </article>

            <article>
                <h3><?php esc_html_e( 'Waterfalls and Canyons', 'panna-wildtour' ); ?></h3>
                <p><?php esc_html_e( 'Nearby natural formations and seasonal falls provide strong half-day excursion options beyond safari sessions.', 'panna-wildtour' ); ?></p>
            </article>

            <article>
                <h3><?php esc_html_e( 'Temple and Heritage Circuits', 'panna-wildtour' ); ?></h3>
                <p><?php esc_html_e( 'Visitors can combine wildlife tours with nearby spiritual and heritage points for a balanced local itinerary.', 'panna-wildtour' ); ?></p>
            </article>
        </div>

        <?php if ( shortcode_exists( 'pwt_destinations' ) ) : ?>
            <div class="section">
                <?php echo do_shortcode( '[pwt_destinations]' ); ?>
            </div>
        <?php endif; ?>
    </section>
</main>
<?php get_footer();
