<?php
/**
 * Email template helpers for Panna Wild Tour theme.
 *
 * @package Panna_Wild_Tour
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function panna_wildtour_get_booking_email_content( $booking_id ) {
    $first_name   = get_post_meta( $booking_id, 'pwt_first_name', true );
    $last_name    = get_post_meta( $booking_id, 'pwt_last_name', true );
    $email        = get_post_meta( $booking_id, 'pwt_email', true );
    $phone        = get_post_meta( $booking_id, 'pwt_phone', true );
    $package_id   = get_post_meta( $booking_id, 'pwt_package_id', true );
    $tour_date    = get_post_meta( $booking_id, 'pwt_tour_date', true );
    $participants = get_post_meta( $booking_id, 'pwt_participants', true );
    $status       = get_post_meta( $booking_id, 'pwt_status', true );
    $payment_id   = get_theme_mod( 'pwt_upi_id', 'pannawildtour@okaxis' );
    $package_name = $package_id ? get_the_title( $package_id ) : esc_html__( 'General Safari Booking', 'panna-wildtour' );

    ob_start();
    ?>
    <div style="font-family: Inter, sans-serif; color: #222222;">
        <h2 style="color: #1f5a32;"><?php esc_html_e( 'Panna Wild Tour Booking Details', 'panna-wildtour' ); ?></h2>
        <p><?php printf( esc_html__( 'Booking ID: %s', 'panna-wildtour' ), esc_html( $booking_id ) ); ?></p>
        <p><?php printf( esc_html__( 'Status: %s', 'panna-wildtour' ), esc_html( $status ) ); ?></p>
        <p><strong><?php esc_html_e( 'Name:', 'panna-wildtour' ); ?></strong> <?php echo esc_html( $first_name . ' ' . $last_name ); ?></p>
        <p><strong><?php esc_html_e( 'Email:', 'panna-wildtour' ); ?></strong> <?php echo esc_html( $email ); ?></p>
        <p><strong><?php esc_html_e( 'Phone:', 'panna-wildtour' ); ?></strong> <?php echo esc_html( $phone ); ?></p>
        <p><strong><?php esc_html_e( 'Package:', 'panna-wildtour' ); ?></strong> <?php echo esc_html( $package_name ); ?></p>
        <p><strong><?php esc_html_e( 'Tour Date:', 'panna-wildtour' ); ?></strong> <?php echo esc_html( $tour_date ); ?></p>
        <p><strong><?php esc_html_e( 'Participants:', 'panna-wildtour' ); ?></strong> <?php echo esc_html( $participants ); ?></p>
        <p><strong><?php esc_html_e( 'UPI ID for payment:', 'panna-wildtour' ); ?></strong> <?php echo esc_html( $payment_id ); ?></p>
        <p><?php esc_html_e( 'Please send payment confirmation to our WhatsApp or email once you have completed the transfer.', 'panna-wildtour' ); ?></p>
    </div>
    <?php
    return ob_get_clean();
}

function panna_wildtour_booking_email_headers() {
    return array( 'Content-Type: text/html; charset=UTF-8' );
}
