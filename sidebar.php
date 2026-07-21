<?php
/**
 * Sidebar template
 *
 * @package Panna_Wild_Tour
 */
?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
<?php else : ?>
    <section class="widget">
        <h2 class="widget-title"><?php esc_html_e( 'Recent Posts', 'panna-wildtour' ); ?></h2>
        <ul>
            <?php wp_get_archives( array( 'type' => 'postbypost', 'limit' => 5 ) ); ?>
        </ul>
    </section>
<?php endif; ?>
