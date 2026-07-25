<?php
/**
 * Main template file
 *
 * @package Panna_Wild_Tour
 */

get_header();
?>
<main id="content" class="site-main site-wrapper">
    <?php if ( have_posts() ) : ?>
        <div class="content-area">
            <section class="entry-content">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                        </header>
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                        <a class="button" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'panna-wildtour' ); ?></a>
                    </article>
                <?php endwhile; ?>
            </section>
            <aside class="widget-area">
                <?php get_sidebar(); ?>
            </aside>
        </div>
        <?php the_posts_pagination(); ?>
    <?php else : ?>
        <section class="entry-content">
            <h1><?php esc_html_e( 'Nothing Found', 'panna-wildtour' ); ?></h1>
            <p><?php esc_html_e( 'It seems we can’t find what you’re looking for. Perhaps searching can help.', 'panna-wildtour' ); ?></p>
            <?php get_search_form(); ?>
        </section>
    <?php endif; ?>
</main>
<?php get_footer();
