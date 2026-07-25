<?php
/**
 * Contact Us page template
 *
 * @package Panna_Wild_Tour
 */

get_header();

$phone = get_theme_mod( 'pwt_contact_phone', '+91 98765 43210' );
$email = get_theme_mod( 'pwt_contact_email', 'info@pannawildtour.com' );
?>
<main id="content" class="site-main site-wrapper page-contact">
    <section class="section">
        <div class="section-header">
            <h1><?php esc_html_e( 'Contact Us', 'panna-wildtour' ); ?></h1>
            <p><?php esc_html_e( 'Share your travel dates, group size, and interests. Our team will suggest practical options for safari slots, stay, and local movement.', 'panna-wildtour' ); ?></p>
        </div>

        <div class="entry-content page-intro-content">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        </div>

        <div class="contact-grid">
            <div class="contact-info">
                <h2><?php esc_html_e( 'Office and Local Support', 'panna-wildtour' ); ?></h2>
                <p><?php esc_html_e( 'Near Madla Safari Gate, Panna district, Madhya Pradesh, India', 'panna-wildtour' ); ?></p>

                <p><strong><?php esc_html_e( 'Phone:', 'panna-wildtour' ); ?></strong> <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', (string) $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a><br>
                <strong><?php esc_html_e( 'Email:', 'panna-wildtour' ); ?></strong> <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>

                <div class="social-links">
                    <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Instagram', 'panna-wildtour' ); ?></a>
                </div>
            </div>

            <div class="contact-form">
                <h2><?php esc_html_e( 'Send Us a Message', 'panna-wildtour' ); ?></h2>
                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <input type="hidden" name="action" value="pwt_submit_contact" />
                    <p><label><?php esc_html_e( 'Name', 'panna-wildtour' ); ?><br><input type="text" name="name" required></label></p>
                    <p><label><?php esc_html_e( 'Email', 'panna-wildtour' ); ?><br><input type="email" name="email" required></label></p>
                    <p><label><?php esc_html_e( 'Message', 'panna-wildtour' ); ?><br><textarea name="message" rows="6" required></textarea></label></p>
                    <p><button class="button" type="submit"><?php esc_html_e( 'Submit Message', 'panna-wildtour' ); ?></button></p>
                </form>
            </div>
        </div>

        <?php if ( shortcode_exists( 'pwt_contact_card' ) ) : ?>
            <div class="section">
                <?php echo do_shortcode( '[pwt_contact_card]' ); ?>
            </div>
        <?php endif; ?>
    </section>
</main>
<?php get_footer();
