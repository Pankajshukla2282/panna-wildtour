<?php
/**
 * Services page template
 *
 * @package Panna_Wild_Tour
 */

get_header();
?>
<main id="content" class="site-main site-wrapper page-services">
    <section class="section">
        <div class="section-header">
            <h1><?php esc_html_e( 'Services We Offer', 'panna-wildtour' ); ?></h1>
            <p><?php esc_html_e( 'Our team supports planning, booking, transport, and on-ground assistance for wildlife-focused trips in and around Panna.', 'panna-wildtour' ); ?></p>
        </div>

        <div class="entry-content page-intro-content">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        </div>

        <div class="service-grid">
            <article class="service-card">
                <h3><?php esc_html_e( 'Safari Planning', 'panna-wildtour' ); ?></h3>
                <p><?php esc_html_e( 'Support with date selection, gate preference, and schedule planning based on season and guest goals.', 'panna-wildtour' ); ?></p>
            </article>

            <article class="service-card">
                <h3><?php esc_html_e( 'Stay and Transfer Coordination', 'panna-wildtour' ); ?></h3>
                <p><?php esc_html_e( 'Resort or homestay matching plus transfer coordination from nearby stations and airport points.', 'panna-wildtour' ); ?></p>
            </article>

            <article class="service-card">
                <h3><?php esc_html_e( 'Family and Group Itineraries', 'panna-wildtour' ); ?></h3>
                <p><?php esc_html_e( 'Balanced day plans combining safari sessions, local attractions, and practical rest windows.', 'panna-wildtour' ); ?></p>
            </article>

            <article class="service-card">
                <h3><?php esc_html_e( 'Permit and Booking Support', 'panna-wildtour' ); ?></h3>
                <p><?php esc_html_e( 'Assistance with safari permit process and package booking submissions during normal and peak season windows.', 'panna-wildtour' ); ?></p>
            </article>

            <article class="service-card">
                <h3><?php esc_html_e( 'Local Experience Add-ons', 'panna-wildtour' ); ?></h3>
                <p><?php esc_html_e( 'Optional cultural and nature-focused add-ons around Panna for guests who want deeper local exposure.', 'panna-wildtour' ); ?></p>
            </article>

            <article class="service-card">
                <h3><?php esc_html_e( 'Post-booking Guest Support', 'panna-wildtour' ); ?></h3>
                <p><?php esc_html_e( 'Continuous support for arrival updates, weather adjustments, and last-mile local coordination.', 'panna-wildtour' ); ?></p>
            </article>
        </div>

        <?php if ( shortcode_exists( 'pwt_packages' ) ) : ?>
            <div class="section">
                <?php echo do_shortcode( '[pwt_packages]' ); ?>
            </div>
        <?php endif; ?>

        <?php if ( shortcode_exists( 'pwt_safaris' ) ) : ?>
            <div class="section">
                <?php echo do_shortcode( '[pwt_safaris]' ); ?>
            </div>
        <?php endif; ?>
    </section>
</main>
<?php get_footer();
