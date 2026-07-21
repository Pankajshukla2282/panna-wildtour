<header class="site-header" role="banner">
    <div class="header-inner">
        <div class="site-branding">
            <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <div>
                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></p>
                    <p class="site-description"><?php bloginfo( 'description' ); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'panna-wildtour' ); ?></button>

        <nav id="site-navigation" class="menu" role="navigation" aria-label="Primary Menu">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_class'     => 'primary-menu',
                'container'      => false,
                'fallback_cb'    => 'wp_page_menu',
            ) );
            ?>
            <div class="header-search">
                <?php get_search_form(); ?>
            </div>
        </nav>
    </div>

    <?php if ( is_active_sidebar( 'header-ad' ) ) : ?>
        <div class="site-header-ad">
            <?php dynamic_sidebar( 'header-ad' ); ?>
        </div>
    <?php endif; ?>
</header>
