<?php
/**
 * About Us page template
 *
 * @package Panna_Wild_Tour
 */

get_header();
$phone = get_theme_mod( 'pwt_contact_phone', '+91 98765 43210' );
?>
<main id="content" class="site-main site-wrapper page-about">
    <section class="section">
        <div class="section-header">
            <h1><?php esc_html_e( 'About Panna Wild Tour', 'panna-wildtour' ); ?></h1>
            <p><?php esc_html_e( 'Panna Wild Tour is a local travel partner helping guests explore the tiger reserve, nearby attractions, and authentic regional experiences with better planning and dependable support.', 'panna-wildtour' ); ?></p>
        </div>

        <div class="entry-content page-intro-content">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        </div>

        <div class="about-grid">
            <div class="about-content">
                <h2><?php esc_html_e( 'Why We Exist', 'panna-wildtour' ); ?></h2>
                <p><?php esc_html_e( 'Our mission is to make wildlife travel in Panna smooth, transparent, and memorable. We coordinate practical details so visitors can focus on the experience rather than logistics.', 'panna-wildtour' ); ?></p>

                <h3><?php esc_html_e( 'Our Mission', 'panna-wildtour' ); ?></h3>
                <p><?php esc_html_e( 'To provide responsible, guest-first wildlife travel with trusted local guidance, verified service partners, and clear communication at every step.', 'panna-wildtour' ); ?></p>

                <h3><?php esc_html_e( 'What We Focus On', 'panna-wildtour' ); ?></h3>
                <ul>
                    <li><?php esc_html_e( 'Tiger reserve safari planning and permit coordination', 'panna-wildtour' ); ?></li>
                    <li><?php esc_html_e( 'Resort and homestay recommendations near key safari gates', 'panna-wildtour' ); ?></li>
                    <li><?php esc_html_e( 'Transfer logistics from Khajuraho and nearby railheads', 'panna-wildtour' ); ?></li>
                    <li><?php esc_html_e( 'Custom itineraries for families, photographers, and nature groups', 'panna-wildtour' ); ?></li>
                </ul>
            </div>

            <aside class="team-card">
                <h2><?php esc_html_e( 'Core Team Roles', 'panna-wildtour' ); ?></h2>
                <div class="team-member">
                    <div class="meta"><strong><?php esc_html_e( 'Trip Advisor', 'panna-wildtour' ); ?></strong><p><?php esc_html_e( 'Creates route plans, safari preferences, and ground coordination for each guest profile.', 'panna-wildtour' ); ?></p></div>
                </div>
                <div class="team-member">
                    <div class="meta"><strong><?php esc_html_e( 'Booking and Finance', 'panna-wildtour' ); ?></strong><p><?php esc_html_e( 'Handles booking confirmations, package costing, and payment follow-up support.', 'panna-wildtour' ); ?></p></div>
                </div>
                <div class="team-member">
                    <div class="meta"><strong><?php esc_html_e( 'Stay and Hospitality', 'panna-wildtour' ); ?></strong><p><?php esc_html_e( 'Coordinates resort and homestay availability and ensures smooth check-in assistance.', 'panna-wildtour' ); ?></p></div>
                </div>
            </aside>
        </div>

        <div class="contact-cta">
            <h3><?php esc_html_e( 'Need a Custom Plan?', 'panna-wildtour' ); ?></h3>
            <p><?php esc_html_e( 'Share your travel month, group size, and interests. Our team can suggest a practical safari-and-stay plan for Panna.', 'panna-wildtour' ); ?></p>
            <p><strong><?php esc_html_e( 'Quick Call:', 'panna-wildtour' ); ?></strong> <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', (string) $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></p>
            <a class="button" href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact-us' ) ) ?: home_url( '/contact-us/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'panna-wildtour' ); ?></a>
        </div>

        <?php if ( shortcode_exists( 'pwt_contact_card' ) ) : ?>
            <div class="section">
                <?php echo do_shortcode( '[pwt_contact_card]' ); ?>
            </div>
        <?php endif; ?>
    </section>
</main>
<?php get_footer();
