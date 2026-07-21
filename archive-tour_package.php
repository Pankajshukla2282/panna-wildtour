<?php
/**
 * Tour package archive template
 *
 * @package Panna_Wild_Tour
 */

get_header();
?>
<main id="content" class="site-main site-wrapper">
    <section class="section">
        <div class="section-header">
            <h1><?php esc_html_e( 'Tour Packages', 'panna-wildtour' ); ?></h1>
            <p><?php esc_html_e( 'Explore safari packages, wildlife tours, and accommodation bundles for Panna National Park.', 'panna-wildtour' ); ?></p>
        </div>
        <div class="package-grid">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="package-card">
                        <h2><?php the_title(); ?></h2>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="package-image"><?php the_post_thumbnail( 'medium' ); ?></div>
                        <?php endif; ?>
                        <p class="package-meta"><?php echo esc_html( panna_wildtour_get_package_duration( get_the_ID() ) ); ?></p>
                        <p class="package-price"><?php echo esc_html__( 'Price:', 'panna-wildtour' ) . ' ' . esc_html( panna_wildtour_get_package_price( get_the_ID() ) ); ?></p>
                        <p><?php the_excerpt(); ?></p>
                        <a class="button secondary" href="<?php the_permalink(); ?>"><?php esc_html_e( 'View Details', 'panna-wildtour' ); ?></a>
                    </article>
                <?php endwhile; ?>
            <?php else : ?>
                <article class="package-card">
                    <p><?php esc_html_e( 'No packages are available right now. Please check back soon.', 'panna-wildtour' ); ?></p>
                </article>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php get_footer();
