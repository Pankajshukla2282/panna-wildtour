<?php
/**
 * 404 template
 *
 * @package Panna_Wild_Tour
 */

get_header();
?>
<main id="content" class="site-main site-wrapper">
    <section class="entry-content">
        <h1><?php esc_html_e( 'Page Not Found', 'panna-wildtour' ); ?></h1>
        <p><?php esc_html_e( 'Sorry, the page you were looking for does not exist. Try the search box or go back to the homepage.', 'panna-wildtour' ); ?></p>
        <?php get_search_form(); ?>
    </section>
</main>
<?php get_footer();
