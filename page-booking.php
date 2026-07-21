<?php
/**
 * Booking page template
 *
 * @package Panna_Wild_Tour
 */

/*
Template Name: Booking Page
*/

get_header();

$selected_package_id = absint( $_GET['package'] ?? 0 );
$packages            = panna_wildtour_get_available_packages();
$upi_id              = get_theme_mod( 'pwt_upi_id', 'pannawildtour@okaxis' );
$booking_success     = absint( $_GET['booking_success'] ?? 0 );
?>
<main id="content" class="site-main site-wrapper page-booking">
    <section class="section">
        <div class="section-header">
            <h1><?php esc_html_e( 'Book Your Panna Tour', 'panna-wildtour' ); ?></h1>
            <p><?php esc_html_e( 'Select a package, submit your details, and follow the UPI payment instructions to confirm your safari booking.', 'panna-wildtour' ); ?></p>
        </div>

        <?php if ( $booking_success ) : ?>
            <div class="booking-success">
                <h2><?php esc_html_e( 'Booking Submitted', 'panna-wildtour' ); ?></h2>
                <p><?php esc_html_e( 'Thank you for booking with us. Your booking request has been received and is awaiting payment confirmation.', 'panna-wildtour' ); ?></p>
                <p><?php esc_html_e( 'Please pay using the UPI details below and keep your booking ID for reference.', 'panna-wildtour' ); ?></p>
                <p><strong><?php esc_html_e( 'Booking ID:', 'panna-wildtour' ); ?></strong> <?php echo esc_html( $booking_success ); ?></p>
            </div>
        <?php endif; ?>

        <div class="booking-grid">
            <div class="booking-form-card">
                <h2><?php esc_html_e( 'Booking Form', 'panna-wildtour' ); ?></h2>
                <form method="post" class="book-form">
                    <?php wp_nonce_field( 'pwt_booking', 'pwt_booking_nonce' ); ?>

                    <div class="book-field">
                        <label for="pwt_first_name"><?php esc_html_e( 'First Name', 'panna-wildtour' ); ?></label>
                        <input type="text" id="pwt_first_name" name="pwt_first_name" required />
                    </div>
                    <div class="book-field">
                        <label for="pwt_last_name"><?php esc_html_e( 'Last Name', 'panna-wildtour' ); ?></label>
                        <input type="text" id="pwt_last_name" name="pwt_last_name" />
                    </div>
                    <div class="book-field">
                        <label for="pwt_email"><?php esc_html_e( 'Email', 'panna-wildtour' ); ?></label>
                        <input type="email" id="pwt_email" name="pwt_email" required />
                    </div>
                    <div class="book-field">
                        <label for="pwt_phone"><?php esc_html_e( 'Phone', 'panna-wildtour' ); ?></label>
                        <input type="tel" id="pwt_phone" name="pwt_phone" required />
                    </div>
                    <div class="book-field">
                        <label for="pwt_tour_date"><?php esc_html_e( 'Preferred Date', 'panna-wildtour' ); ?></label>
                        <input type="date" id="pwt_tour_date" name="pwt_tour_date" required />
                    </div>
                    <div class="book-field">
                        <label for="pwt_participants"><?php esc_html_e( 'Participants', 'panna-wildtour' ); ?></label>
                        <input type="number" id="pwt_participants" name="pwt_participants" value="1" min="1" required />
                    </div>
                    <div class="book-field">
                        <label for="pwt_package_id"><?php esc_html_e( 'Choose a Package', 'panna-wildtour' ); ?></label>
                        <select id="pwt_package_id" name="pwt_package_id">
                            <option value="0"><?php esc_html_e( 'General safari package', 'panna-wildtour' ); ?></option>
                            <?php if ( $packages->have_posts() ) : ?>
                                <?php while ( $packages->have_posts() ) : $packages->the_post(); ?>
                                    <option value="<?php echo esc_attr( get_the_ID() ); ?>" <?php selected( get_the_ID(), $selected_package_id ); ?>><?php the_title(); ?></option>
                                <?php endwhile; wp_reset_postdata(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <button type="submit" name="pwt_booking_submit" class="button"><?php esc_html_e( 'Submit Booking', 'panna-wildtour' ); ?></button>
                </form>
            </div>

            <aside class="payment-card">
                <h2><?php esc_html_e( 'Pay with UPI', 'panna-wildtour' ); ?></h2>
                <div class="upi-qr">
                    <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/upi-qr.svg' ) ); ?>" alt="UPI QR code" />
                </div>
                <p><?php esc_html_e( 'Scan the QR code or use the UPI ID below to pay instantly.', 'panna-wildtour' ); ?></p>
                <p class="upi-id"><strong><?php esc_html_e( 'UPI ID:', 'panna-wildtour' ); ?></strong> <?php echo esc_html( $upi_id ); ?></p>
                <p><?php esc_html_e( 'For urgent bookings, send proof of payment to our WhatsApp or email and we will confirm your spot.', 'panna-wildtour' ); ?></p>
                <div class="booking-benefits">
                    <h3><?php esc_html_e( 'Why pay by UPI?', 'panna-wildtour' ); ?></h3>
                    <ul>
                        <li><?php esc_html_e( 'Instant confirmation', 'panna-wildtour' ); ?></li>
                        <li><?php esc_html_e( 'Secure, cashless payment', 'panna-wildtour' ); ?></li>
                        <li><?php esc_html_e( 'Easy mobile payment', 'panna-wildtour' ); ?></li>
                    </ul>
                </div>
            </aside>
        </div>

        <?php if ( $packages->have_posts() ) : ?>
            <div class="section-header">
                <h2><?php esc_html_e( 'Popular Packages', 'panna-wildtour' ); ?></h2>
            </div>
            <div class="package-grid">
                <?php while ( $packages->have_posts() ) : $packages->the_post(); ?>
                    <article class="package-card">
                        <h3><?php the_title(); ?></h3>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="package-image"><?php the_post_thumbnail( 'large' ); ?></div>
                        <?php endif; ?>
                        <p class="package-meta"><?php echo esc_html( panna_wildtour_get_package_duration( get_the_ID() ) ); ?></p>
                        <p class="package-price"><?php echo esc_html__( 'Starting from', 'panna-wildtour' ) . ' ' . esc_html( panna_wildtour_get_package_price( get_the_ID() ) ); ?></p>
                        <p><?php the_excerpt(); ?></p>
                        <a class="button secondary" href="<?php echo esc_url( add_query_arg( 'package', get_the_ID(), get_permalink() ) ); ?>"><?php esc_html_e( 'Book This Package', 'panna-wildtour' ); ?></a>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php get_footer();
