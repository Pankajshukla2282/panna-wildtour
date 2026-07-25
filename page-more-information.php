<?php
/**
 * More Information / Blog listing page template
 *
 * @package Panna_Wild_Tour
 */

get_header();
?>
<main id="content" class="site-main site-wrapper page-more-information">
    <section class="section">
        <div class="section-header">
            <h1><?php esc_html_e( 'More Information', 'panna-wildtour' ); ?></h1>
            <p><?php esc_html_e( 'Planning guides, travel notes, and practical updates for visitors preparing a wildlife trip to Panna.', 'panna-wildtour' ); ?></p>
        </div>

        <div class="entry-content page-intro-content">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        </div>

        <div class="posts-list">
            <?php
            $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 10 ) );
            if ( $posts->have_posts() ) :
                while ( $posts->have_posts() ) : $posts->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" class="post-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-thumb"><?php the_post_thumbnail( 'medium' ); ?></div>
                        <?php endif; ?>
                        <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="post-excerpt"><?php the_excerpt(); ?></div>
                    </article>
                <?php endwhile; wp_reset_postdata();
            else : ?>
                <p><?php esc_html_e( 'No posts found.', 'panna-wildtour' ); ?></p>
            <?php endif; ?>
        </div>

        <?php if ( shortcode_exists( 'pwt_faq' ) ) : ?>
            <div class="section">
                <?php echo do_shortcode( '[pwt_faq]' ); ?>
            </div>
        <?php endif; ?>

        <?php if ( shortcode_exists( 'pwt_testimonials' ) ) : ?>
            <div class="section">
                <?php echo do_shortcode( '[pwt_testimonials]' ); ?>
            </div>
        <?php endif; ?>
    </section>
</main>
<?php get_footer();
