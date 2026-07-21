<?php
/**
 * Front Page template for Panna Wild Tour
 *
 * @package Panna_Wild_Tour
 */

get_header();

$hero_title = get_theme_mod( 'pwt_hero_title', esc_html__( 'Live the Nature at Panna Wild Tour', 'panna-wildtour' ) );
$hero_text  = get_theme_mod( 'pwt_hero_text', esc_html__( 'Discover tiger safaris, wildlife tours, and cultural trips around Panna National Park with experienced guides and trusted local services.', 'panna-wildtour' ) );
$hero_phone = get_theme_mod( 'pwt_contact_phone', '+91 98765 43210' );
?>

<main id="content" class="site-main">
    <section class="hero">
        <div class="hero-content">
            <span class="eyebrow"><?php esc_html_e( 'Panna Wildlife Tours', 'panna-wildtour' ); ?></span>
            <h1><?php echo esc_html( $hero_title ); ?></h1>
            <p><?php echo esc_html( $hero_text ); ?></p>
            <div class="hero-actions">
                <a class="button" href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ?: home_url( '/booking/' ) ); ?>"><?php esc_html_e( 'Book a Safari', 'panna-wildtour' ); ?></a>
                <a class="button secondary" href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact-us' ) ) ?: home_url( '/contact-us/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'panna-wildtour' ); ?></a>
            </div>
            <p class="hero-contact"><?php esc_html_e( 'Call for fast booking:', 'panna-wildtour' ); ?> <a href="tel:<?php echo esc_attr( $hero_phone ); ?>"><?php echo esc_html( $hero_phone ); ?></a></p>
        </div>
        <div class="hero-media">
            <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/hero.svg' ) ); ?>" alt="Panna National Park safari" />
        </div>
    </section>

    <section class="section" id="services">
        <div class="section-header">
            <h2><?php esc_html_e( 'Services We Offer', 'panna-wildtour' ); ?></h2>
            <p><?php esc_html_e( 'Our local team provides guided safaris, booking support, transport logistics and special experiences for your trip to Panna.', 'panna-wildtour' ); ?></p>
        </div>
        <div class="service-grid">
            <article class="service-card">
                <h3><?php esc_html_e( 'Safari Booking', 'panna-wildtour' ); ?></h3>
                <p><?php esc_html_e( 'Reserve tiger safaris, jeep tours, boat rides and early morning wildlife drives through Panna Reserve.', 'panna-wildtour' ); ?></p>
            </article>
            <article class="service-card">
                <h3><?php esc_html_e( 'Local Guide Support', 'panna-wildtour' ); ?></h3>
                <p><?php esc_html_e( 'Expert local guides help you discover wildlife, waterfalls, culture and archaeological sites safely.', 'panna-wildtour' ); ?></p>
            </article>
            <article class="service-card">
                <h3><?php esc_html_e( 'Logistics & Transport', 'panna-wildtour' ); ?></h3>
                <p><?php esc_html_e( 'We arrange pickup, drop-off, accommodation coordination and special requests for your group.', 'panna-wildtour' ); ?></p>
            </article>
        </div>
    </section>

    <section class="section" id="highlights">
        <div class="section-header">
            <h2><?php esc_html_e( 'Why Choose Panna Wild Tour?', 'panna-wildtour' ); ?></h2>
        </div>
        <div class="feature-grid">
            <article class="feature-card">
                <h3><?php esc_html_e( 'Trusted Local Experts', 'panna-wildtour' ); ?></h3>
                <p><?php esc_html_e( 'We know Panna jungles, wildlife timings, and the safest routes for the most memorable safari.', 'panna-wildtour' ); ?></p>
            </article>
            <article class="feature-card">
                <h3><?php esc_html_e( 'Flexible Packages', 'panna-wildtour' ); ?></h3>
                <p><?php esc_html_e( 'From short day trips to multi-day tour packages, our services are built around your travel style.', 'panna-wildtour' ); ?></p>
            </article>
            <article class="feature-card">
                <h3><?php esc_html_e( 'Personalized Assistance', 'panna-wildtour' ); ?></h3>
                <p><?php esc_html_e( 'We assist with ticket bookings, special requests and on-demand services while you explore.', 'panna-wildtour' ); ?></p>
            </article>
        </div>
    </section>

    <section class="section" id="gallery">
        <div class="section-header">
            <h2><?php esc_html_e( 'Special Memories', 'panna-wildtour' ); ?></h2>
            <p><?php esc_html_e( 'A snapshot gallery of wildlife, landscapes and unforgettable moments from Panna tours.', 'panna-wildtour' ); ?></p>
        </div>
        <div class="gallery-grid">
            <?php for ( $i = 1; $i <= 6; $i++ ) : ?>
                <div class="gallery-item">
                    <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/gallery-' . $i . '.svg' ) ); ?>" alt="Panna Gallery Image <?php echo absint( $i ); ?>" />
                </div>
            <?php endfor; ?>
        </div>
    </section>

    <section class="section" id="testimonials">
        <div class="section-header">
            <h2><?php esc_html_e( 'What People Say About Us', 'panna-wildtour' ); ?></h2>
            <p><?php esc_html_e( 'Feedback from recent guests who explored Panna jungles and wildlife tours with our team.', 'panna-wildtour' ); ?></p>
        </div>
        <div class="testimonial-grid">
            <article class="testimonial-card">
                <p><?php esc_html_e( 'This is a very good agency. These people really take care of tourists and their emotions. They focused on my requirements and arranged resources for my journalism work.', 'panna-wildtour' ); ?></p>
                <div class="testimonial-meta"><span><?php esc_html_e( 'Lakhan Lal', 'panna-wildtour' ); ?></span><span><?php esc_html_e( 'Journalist', 'panna-wildtour' ); ?></span></div>
            </article>
            <article class="testimonial-card">
                <p><?php esc_html_e( 'I am impressed with the wild knowledge of the guide. They helped with ticket booking, safari booking and other ad-hoc services.', 'panna-wildtour' ); ?></p>
                <div class="testimonial-meta"><span><?php esc_html_e( 'Anshuman', 'panna-wildtour' ); ?></span><span><?php esc_html_e( 'Customer', 'panna-wildtour' ); ?></span></div>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="ad-slot">
            <?php if ( is_active_sidebar( 'footer-ad' ) ) : ?>
                <?php dynamic_sidebar( 'footer-ad' ); ?>
            <?php else : ?>
                <?php esc_html_e( 'Place your advertisement or promotion here.', 'panna-wildtour' ); ?>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer();
