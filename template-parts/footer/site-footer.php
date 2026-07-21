<footer class="site-footer" role="contentinfo">
    <div class="site-wrapper footer-inner">
        <div class="footer-widget">
            <h3><?php esc_html_e( 'About Panna Wild Tour', 'panna-wildtour' ); ?></h3>
            <p><?php esc_html_e( 'A trusted local partner for jungle safaris, wildlife tours, and booking services at Panna National Park in Madhya Pradesh.', 'panna-wildtour' ); ?></p>
        </div>
        <div class="footer-widget">
            <h3><?php esc_html_e( 'Quick Links', 'panna-wildtour' ); ?></h3>
            <?php
            wp_nav_menu( array(
                'theme_location' => 'footer',
                'menu_class'     => 'footer-menu',
                'container'      => false,
                'depth'          => 1,
                'fallback_cb'    => false,
            ) );
            ?>
        </div>
        <div class="footer-widget">
            <h3><?php esc_html_e( 'Contact', 'panna-wildtour' ); ?></h3>
            <p><?php echo esc_html( get_theme_mod( 'pwt_contact_phone', '+91 98765 43210' ) ); ?></p>
            <p><a href="mailto:<?php echo esc_attr( get_theme_mod( 'pwt_contact_email', 'info@pannawildtour.com' ) ); ?>"><?php echo esc_html( get_theme_mod( 'pwt_contact_email', 'info@pannawildtour.com' ) ); ?></a></p>
        </div>
        <?php if ( is_active_sidebar( 'footer-ad' ) ) : ?>
            <div class="footer-widget">
                <?php dynamic_sidebar( 'footer-ad' ); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="site-wrapper footer-credit">
        <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'panna-wildtour' ); ?></p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
