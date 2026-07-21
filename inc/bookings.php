<?php
/**
 * Booking and package functionality for Panna Wild Tour theme.
 *
 * @package Panna_Wild_Tour
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function panna_wildtour_register_post_types() {
    register_post_type( 'tour_package', array(
        'labels' => array(
            'name'               => esc_html__( 'Tour Packages', 'panna-wildtour' ),
            'singular_name'      => esc_html__( 'Tour Package', 'panna-wildtour' ),
            'add_new_item'       => esc_html__( 'Add New Package', 'panna-wildtour' ),
            'edit_item'          => esc_html__( 'Edit Package', 'panna-wildtour' ),
            'new_item'           => esc_html__( 'New Package', 'panna-wildtour' ),
            'view_item'          => esc_html__( 'View Package', 'panna-wildtour' ),
            'search_items'       => esc_html__( 'Search Packages', 'panna-wildtour' ),
            'not_found'          => esc_html__( 'No packages found.', 'panna-wildtour' ),
            'not_found_in_trash' => esc_html__( 'No packages found in Trash.', 'panna-wildtour' ),
        ),
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => array( 'slug' => 'packages' ),
        'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-palmtree',
    ) );

    register_post_type( 'tour_booking', array(
        'labels' => array(
            'name'               => esc_html__( 'Bookings', 'panna-wildtour' ),
            'singular_name'      => esc_html__( 'Booking', 'panna-wildtour' ),
            'all_items'          => esc_html__( 'All Bookings', 'panna-wildtour' ),
            'add_new_item'       => esc_html__( 'Add New Booking', 'panna-wildtour' ),
            'edit_item'          => esc_html__( 'Edit Booking', 'panna-wildtour' ),
        ),
        'public'       => false,
        'has_archive'  => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'supports'     => array( 'title' ),
        'menu_icon'    => 'dashicons-book-alt',
    ) );
}
add_action( 'init', 'panna_wildtour_register_post_types' );

function panna_wildtour_package_meta_boxes() {
    add_meta_box(
        'pwt_package_details',
        esc_html__( 'Package Details', 'panna-wildtour' ),
        'panna_wildtour_package_meta_box_callback',
        'tour_package',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'panna_wildtour_package_meta_boxes' );

function panna_wildtour_package_meta_box_callback( $post ) {
    wp_nonce_field( 'pwt_package_meta', 'pwt_package_meta_nonce' );

    $price    = get_post_meta( $post->ID, 'pwt_package_price', true );
    $duration = get_post_meta( $post->ID, 'pwt_package_duration', true );
    $code     = get_post_meta( $post->ID, 'pwt_package_code', true );
    ?>
    <p>
        <label for="pwt_package_price"><?php esc_html_e( 'Price per person', 'panna-wildtour' ); ?></label><br>
        <input type="text" id="pwt_package_price" name="pwt_package_price" value="<?php echo esc_attr( $price ); ?>" class="widefat" />
    </p>
    <p>
        <label for="pwt_package_duration"><?php esc_html_e( 'Duration', 'panna-wildtour' ); ?></label><br>
        <input type="text" id="pwt_package_duration" name="pwt_package_duration" value="<?php echo esc_attr( $duration ); ?>" class="widefat" />
    </p>
    <p>
        <label for="pwt_package_code"><?php esc_html_e( 'Package Code', 'panna-wildtour' ); ?></label><br>
        <input type="text" id="pwt_package_code" name="pwt_package_code" value="<?php echo esc_attr( $code ); ?>" class="widefat" />
    </p>
    <?php
}

function panna_wildtour_save_package_meta( $post_id ) {
    if ( ! isset( $_POST['pwt_package_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['pwt_package_meta_nonce'] ) ), 'pwt_package_meta' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( isset( $_POST['pwt_package_price'] ) ) {
        update_post_meta( $post_id, 'pwt_package_price', sanitize_text_field( wp_unslash( $_POST['pwt_package_price'] ) ) );
    }

    if ( isset( $_POST['pwt_package_duration'] ) ) {
        update_post_meta( $post_id, 'pwt_package_duration', sanitize_text_field( wp_unslash( $_POST['pwt_package_duration'] ) ) );
    }

    if ( isset( $_POST['pwt_package_code'] ) ) {
        update_post_meta( $post_id, 'pwt_package_code', sanitize_text_field( wp_unslash( $_POST['pwt_package_code'] ) ) );
    }
}
add_action( 'save_post_tour_package', 'panna_wildtour_save_package_meta' );

function panna_wildtour_handle_booking_submission() {
    if ( ! isset( $_POST['pwt_booking_submit'] ) || ! is_page_template( 'page-booking.php' ) ) {
        return;
    }

    if ( ! isset( $_POST['pwt_booking_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['pwt_booking_nonce'] ) ), 'pwt_booking' ) ) {
        wp_die( esc_html__( 'Booking submission failed. Please try again.', 'panna-wildtour' ) );
    }

    $first_name   = sanitize_text_field( wp_unslash( $_POST['pwt_first_name'] ?? '' ) );
    $last_name    = sanitize_text_field( wp_unslash( $_POST['pwt_last_name'] ?? '' ) );
    $email        = sanitize_email( wp_unslash( $_POST['pwt_email'] ?? '' ) );
    $phone        = sanitize_text_field( wp_unslash( $_POST['pwt_phone'] ?? '' ) );
    $package_id   = absint( $_POST['pwt_package_id'] ?? 0 );
    $tour_date    = sanitize_text_field( wp_unslash( $_POST['pwt_tour_date'] ?? '' ) );
    $participants = absint( $_POST['pwt_participants'] ?? 1 );

    if ( empty( $first_name ) || empty( $email ) || empty( $phone ) || empty( $tour_date ) ) {
        wp_die( esc_html__( 'Please complete all required fields.', 'panna-wildtour' ) );
    }

    $package_title = $package_id ? get_the_title( $package_id ) : esc_html__( 'General Safari Booking', 'panna-wildtour' );
    $package_price = $package_id ? get_post_meta( $package_id, 'pwt_package_price', true ) : '';
    $amount_label  = $package_price ? sprintf( '%s x %d', esc_html( $package_price ), $participants ) : esc_html__( 'Contact for pricing', 'panna-wildtour' );
    $booking_title = sprintf( '%s: %s %s', esc_html__( 'Booking', 'panna-wildtour' ), $package_title, $first_name );

    $booking_id = wp_insert_post( array(
        'post_title'  => wp_strip_all_tags( $booking_title ),
        'post_status' => 'publish',
        'post_type'   => 'tour_booking',
        'meta_input'  => array(
            'pwt_first_name'   => $first_name,
            'pwt_last_name'    => $last_name,
            'pwt_email'        => $email,
            'pwt_phone'        => $phone,
            'pwt_package_id'   => $package_id,
            'pwt_tour_date'    => $tour_date,
            'pwt_participants' => $participants,
            'pwt_amount_label' => $amount_label,
            'pwt_status'       => 'Pending Payment',
        ),
    ) );

    if ( is_wp_error( $booking_id ) ) {
        wp_die( esc_html__( 'Unable to submit booking. Please try again later.', 'panna-wildtour' ) );
    }

    $admin_email = get_bloginfo( 'admin_email' );
    $subject     = sprintf( esc_html__( 'New Booking: %s', 'panna-wildtour' ), $booking_title );
    $message     = sprintf(
        esc_html__( 'A new booking has been received. Booking ID: %d', 'panna-wildtour' ),
        $booking_id
    );
    $message    .= "\n\n" . esc_html__( 'Customer details:', 'panna-wildtour' ) . "\n";
    $message    .= esc_html__( 'Name:', 'panna-wildtour' ) . ' ' . $first_name . ' ' . $last_name . "\n";
    $message    .= esc_html__( 'Email:', 'panna-wildtour' ) . ' ' . $email . "\n";
    $message    .= esc_html__( 'Phone:', 'panna-wildtour' ) . ' ' . $phone . "\n";
    $message    .= esc_html__( 'Package:', 'panna-wildtour' ) . ' ' . $package_title . "\n";
    $message    .= esc_html__( 'Tour Date:', 'panna-wildtour' ) . ' ' . $tour_date . "\n";
    $message    .= esc_html__( 'Participants:', 'panna-wildtour' ) . ' ' . $participants . "\n";
    $message    .= esc_html__( 'Amount or request:', 'panna-wildtour' ) . ' ' . $amount_label . "\n";

    wp_mail( $admin_email, $subject, $message );

    if ( is_email( $email ) ) {
        $customer_message = sprintf( esc_html__( 'Thank you for booking with Panna Wild Tour. Your booking has been received and is pending payment. Booking ID: %d', 'panna-wildtour' ), $booking_id );
        $customer_message .= "\n\n" . esc_html__( 'Please complete payment using the UPI details on the booking page.', 'panna-wildtour' );

        wp_mail( $email, esc_html__( 'Your Panna Wild Tour booking request', 'panna-wildtour' ), $customer_message );
    }

    $booking_url = add_query_arg( 'booking_success', intval( $booking_id ), wp_get_referer() ?: get_permalink( get_page_by_path( 'booking' ) ) );
    wp_safe_redirect( esc_url_raw( $booking_url ) );
    exit;
}
add_action( 'template_redirect', 'panna_wildtour_handle_booking_submission' );

function panna_wildtour_get_available_packages() {
    $args = array(
        'post_type'      => 'tour_package',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    $search   = sanitize_text_field( wp_unslash( $_GET['package_search'] ?? '' ) );
    $duration = sanitize_text_field( wp_unslash( $_GET['package_duration'] ?? '' ) );

    if ( $search ) {
        $args['s'] = $search;
    }

    if ( $duration ) {
        $args['meta_query'] = array(
            array(
                'key'     => 'pwt_package_duration',
                'value'   => $duration,
                'compare' => 'LIKE',
            ),
        );
    }

    $query = new WP_Query( $args );

    return $query;
}

function panna_wildtour_get_package_price( $post_id ) {
    return get_post_meta( $post_id, 'pwt_package_price', true );
}

function panna_wildtour_get_package_duration( $post_id ) {
    return get_post_meta( $post_id, 'pwt_package_duration', true );
}

function panna_wildtour_get_page_url( $slug ) {
    $page = get_page_by_path( $slug );
    return $page ? get_permalink( $page ) : home_url( '/' . untrailingslashit( $slug ) . '/' );
}

function panna_wildtour_dashboard_bookings_widget() {
    $total_bookings   = wp_count_posts( 'tour_booking' )->publish;
    $pending_count    = new WP_Query( array(
        'post_type'      => 'tour_booking',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => array(
            array(
                'key'     => 'pwt_status',
                'value'   => 'Pending Payment',
                'compare' => '=',
            ),
        ),
    ) );
    $recent_bookings = new WP_Query( array(
        'post_type'      => 'tour_booking',
        'posts_per_page' => 5,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );

    echo '<p><strong>' . esc_html__( 'Total bookings:', 'panna-wildtour' ) . '</strong> ' . absint( $total_bookings ) . '</p>';
    echo '<p><strong>' . esc_html__( 'Pending payment:', 'panna-wildtour' ) . '</strong> ' . absint( $pending_count->found_posts ) . '</p>';

    if ( $recent_bookings->have_posts() ) {
        echo '<h4>' . esc_html__( 'Recent bookings', 'panna-wildtour' ) . '</h4>';
        echo '<ul>';
        while ( $recent_bookings->have_posts() ) {
            $recent_bookings->the_post();
            printf(
                '<li><a href="%1$s">%2$s</a> - %3$s</li>',
                esc_url( get_edit_post_link() ),
                esc_html( get_the_title() ),
                esc_html( get_post_meta( get_the_ID(), 'pwt_status', true ) )
            );
        }
        echo '</ul>';
        wp_reset_postdata();
    }
}

function panna_wildtour_register_dashboard_widgets() {
    wp_add_dashboard_widget(
        'pwt_booking_summary',
        esc_html__( 'Panna Wild Tour Bookings', 'panna-wildtour' ),
        'panna_wildtour_dashboard_bookings_widget'
    );
}
add_action( 'wp_dashboard_setup', 'panna_wildtour_register_dashboard_widgets' );
