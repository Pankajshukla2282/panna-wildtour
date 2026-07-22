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
            <h1>More Information</h1>
            <p>Latest articles, stories and updates from Panna — wildlife encounters, travel notes and conservation stories.</p>
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
                <p>No posts found.</p>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php get_footer();
