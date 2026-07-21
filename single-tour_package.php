<?php
/**
 * Single tour package display
 *
 * @package Panna_Wild_Tour
 */

get_header();
?>
<main id="content" class="site-main site-wrapper">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'package-detail' ); ?>>
            <header class="entry-header section-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <p class="package-meta"><?php echo esc_html( panna_wildtour_get_package_duration( get_the_ID() ) ); ?></p>
                <p class="package-price"><?php echo esc_html__( 'Price:', 'panna-wildtour' ) . ' ' . esc_html( panna_wildtour_get_package_price( get_the_ID() ) ); ?></p>
            </header>
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="package-image"><?php the_post_thumbnail( 'large' ); ?></div>
            <?php endif; ?>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
            <footer class="entry-footer">
                <a class="button" href="<?php echo esc_url( add_query_arg( 'package', get_the_ID(), get_permalink( get_page_by_path( 'booking' ) ) ) ); ?>"><?php esc_html_e( 'Book This Package', 'panna-wildtour' ); ?></a>
            </footer>
        </article>
    <?php endwhile; ?>
</main>
<?php get_footer();
