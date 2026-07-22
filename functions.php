<?php
/**
 * Panna Wild Tour functions and definitions
 *
 * @package Panna_Wild_Tour
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function panna_wildtour_theme_setup() {
    load_theme_textdomain( 'panna-wildtour', get_template_directory() . '/languages' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style' ) );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );

    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'panna-wildtour' ),
        'footer'  => esc_html__( 'Footer Menu', 'panna-wildtour' ),
    ) );

    add_theme_support( 'custom-line-height' );
    add_editor_style( array( 'assets/css/style.css', 'assets/css/editor-style.css' ) );
}
add_action( 'after_setup_theme', 'panna_wildtour_theme_setup' );

function panna_wildtour_block_editor_styles() {
    wp_enqueue_style( 'panna-wildtour-block-editor-styles', get_theme_file_uri( '/assets/css/editor-style.css' ), array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'enqueue_block_editor_assets', 'panna_wildtour_block_editor_styles' );

function panna_wildtour_scripts() {
    wp_enqueue_style( 'panna-wildtour-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_script( 'panna-wildtour-theme', get_theme_file_uri( '/assets/js/theme.js' ), array(), filemtime( get_stylesheet_directory() . '/assets/js/theme.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'panna_wildtour_scripts' );

function panna_wildtour_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Primary Sidebar', 'panna-wildtour' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here for blog and page sidebar content.', 'panna-wildtour' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Header Ad Slot', 'panna-wildtour' ),
        'id'            => 'header-ad',
        'description'   => esc_html__( 'Display a header advertisement or announcement.', 'panna-wildtour' ),
        'before_widget' => '<div class="widget ad-slot" id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Ad Slot', 'panna-wildtour' ),
        'id'            => 'footer-ad',
        'description'   => esc_html__( 'Display a footer advertisement or promotion.', 'panna-wildtour' ),
        'before_widget' => '<div class="widget ad-slot" id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'panna_wildtour_widgets_init' );

require get_template_directory() . '/inc/bookings.php';
require get_template_directory() . '/inc/schema.php';
require get_template_directory() . '/inc/email-template.php';

function panna_wildtour_meta_description() {
    if ( is_singular() ) {
        $description = get_the_excerpt();
    } else {
        $description = get_bloginfo( 'description' );
    }

    if ( empty( $description ) ) {
        $description = esc_html__( 'Panna Wild Tours is your trusted partner for Panna tiger reserve safaris, local attractions, tours and bookings in Madhya Pradesh.', 'panna-wildtour' );
    }

    echo '<meta name="description" content="' . esc_attr( wp_strip_all_tags( $description ) ) . '" />' . "\n";
}
add_action( 'wp_head', 'panna_wildtour_meta_description' );

function panna_wildtour_search_form( $form ) {
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">';
    $form .= '<label><span class="screen-reader-text">' . esc_html__( 'Search for:', 'panna-wildtour' ) . '</span>';
    $form .= '<input type="search" class="search-field" placeholder="' . esc_attr__( 'Search …', 'panna-wildtour' ) . '" value="' . get_search_query() . '" name="s" />';
    $form .= '</label>';
    $form .= '<button type="submit" class="search-submit">' . esc_html__( 'Search', 'panna-wildtour' ) . '</button>';
    $form .= '</form>';
    return $form;
}
add_filter( 'get_search_form', 'panna_wildtour_search_form' );

function panna_wildtour_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'pwt_frontpage', array(
        'title'       => esc_html__( 'Homepage Settings', 'panna-wildtour' ),
        'priority'    => 160,
        'description' => esc_html__( 'Customize the homepage hero section and feature highlights.', 'panna-wildtour' ),
    ) );

    $wp_customize->add_setting( 'pwt_hero_title', array(
        'default'           => esc_html__( 'Live the Nature at Panna Wild Tour', 'panna-wildtour' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'pwt_hero_title', array(
        'label'   => esc_html__( 'Hero Title', 'panna-wildtour' ),
        'section' => 'pwt_frontpage',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'pwt_hero_text', array(
        'default'           => esc_html__( 'Discover tiger safaris, wildlife tours, and cultural trips around Panna National Park with experienced guides and trusted local services.', 'panna-wildtour' ),
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );

    $wp_customize->add_control( 'pwt_hero_text', array(
        'label'   => esc_html__( 'Hero Text', 'panna-wildtour' ),
        'section' => 'pwt_frontpage',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'pwt_contact_phone', array(
        'default'           => '+91 98765 43210',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'pwt_contact_phone', array(
        'label'   => esc_html__( 'Contact Phone', 'panna-wildtour' ),
        'section' => 'pwt_frontpage',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'pwt_contact_email', array(
        'default'           => 'info@pannawildtour.com',
        'sanitize_callback' => 'sanitize_email',
    ) );

    $wp_customize->add_control( 'pwt_contact_email', array(
        'label'   => esc_html__( 'Contact Email', 'panna-wildtour' ),
        'section' => 'pwt_frontpage',
        'type'    => 'email',
    ) );

    $wp_customize->add_setting( 'pwt_upi_id', array(
        'default'           => esc_html__( 'pannawildtour@okaxis', 'panna-wildtour' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'pwt_upi_id', array(
        'label'   => esc_html__( 'UPI ID', 'panna-wildtour' ),
        'section' => 'pwt_frontpage',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'pwt_whatsapp_number', array(
        'default'           => esc_html__( '+91 98765 43210', 'panna-wildtour' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'pwt_whatsapp_number', array(
        'label'   => esc_html__( 'WhatsApp / Contact Number', 'panna-wildtour' ),
        'section' => 'pwt_frontpage',
        'type'    => 'text',
    ) );
}
add_action( 'customize_register', 'panna_wildtour_customize_register' );

function panna_wildtour_custom_logo() {
    if ( has_custom_logo() ) {
        the_custom_logo();
    } else {
        echo '<a class="site-title" href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a>';
    }
}

function panna_wildtour_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'panna_wildtour_excerpt_length', 999 );

function panna_wildtour_add_slug_body_class( $classes ) {
    if ( is_singular() ) {
        global $post;
        $classes[] = 'page-' . $post->post_name;
    }
    return $classes;
}
add_filter( 'body_class', 'panna_wildtour_add_slug_body_class' );

function panna_wildtour_handle_contact_submission() {
    if ( ! isset( $_POST['action'] ) || 'pwt_submit_contact' !== $_POST['action'] ) {
        return;
    }

    $name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
    $email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
    $message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_safe_redirect( wp_get_referer() ?: home_url( '/' ) );
        exit;
    }

    $admin_email = get_bloginfo( 'admin_email' );
    $subject     = sprintf( 'Contact form: %s', $name );
    $body        = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    wp_mail( $admin_email, $subject, $body );

    wp_safe_redirect( add_query_arg( 'contact_sent', '1', wp_get_referer() ?: home_url( '/' ) ) );
    exit;
}
add_action( 'admin_post_nopriv_pwt_submit_contact', 'panna_wildtour_handle_contact_submission' );
add_action( 'admin_post_pwt_submit_contact', 'panna_wildtour_handle_contact_submission' );

/**
 * Create default pages on theme activation if they don't exist.
 */
function panna_wildtour_create_default_pages() {
    if ( get_option( 'pwt_default_pages_created' ) ) {
        return;
    }

    $pages = array(
        'about-us'         => 'About Us',
        'contact-us'       => 'Contact Us',
        'services'         => 'Services',
        'attractions'      => 'Attractions',
        'booking'          => 'Booking',
        'more-information' => 'More Information',
    );

    foreach ( $pages as $slug => $title ) {
        // Skip if a page with this path already exists.
        if ( get_page_by_path( $slug ) ) {
            continue;
        }

        $content = '';

        switch ( $slug ) {
            case 'about-us':
                $content = 'Learn about Panna Wild Tour, our mission, team and how we help visitors experience the Panna jungles.';
                break;
            case 'contact-us':
                $content = 'Get in touch with us for bookings, queries and support.';
                break;
            case 'services':
                $content = 'Explore our guided safaris, logistics, on-demand and special services around Panna.';
                break;
            case 'attractions':
                $content = 'Highlights around Panna: Panna Tiger Reserve, Ken river, waterfalls, plateaus and local temples.';
                break;
            case 'booking':
                $content = 'Book your safari package. Use the booking page to select packages and submit your details.';
                break;
            case 'more-information':
                $content = 'Read our latest posts and wildlife stories from Panna.';
                break;
        }

        wp_insert_post( array(
            'post_title'   => wp_strip_all_tags( $title ),
            'post_name'    => $slug,
            'post_content' => $content,
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ) );
    }

    update_option( 'pwt_default_pages_created', 1 );
}
add_action( 'after_switch_theme', 'panna_wildtour_create_default_pages' );
