<?php
/**
 * Panna Wild Tour functions and definitions
 *
 * @package Panna_Wild_Tour
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Detect whether the Panna Wild Tour plugin runtime is available.
 */
function panna_wildtour_has_pwt_plugin() {
    return class_exists( '\\PWT\\Core\\Application' ) || shortcode_exists( 'pwt_homepage' ) || post_type_exists( 'pwt_package' );
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
    $theme_version = wp_get_theme()->get( 'Version' );
    $script_path   = get_stylesheet_directory() . '/assets/js/theme.js';
    $script_ver    = file_exists( $script_path ) ? (string) filemtime( $script_path ) : $theme_version;

    wp_enqueue_style( 'panna-wildtour-style', get_stylesheet_uri(), array(), $theme_version );
    wp_enqueue_script( 'panna-wildtour-theme', get_theme_file_uri( '/assets/js/theme.js' ), array(), $script_ver, true );
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
    // Respect SEO plugins to avoid duplicate meta description tags.
    if ( defined( 'RANK_MATH_VERSION' ) || defined( 'WPSEO_VERSION' ) ) {
        return;
    }

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

function panna_wildtour_default_page_blueprint() {
    return array(
        'about-us' => array(
            'title'    => 'About Us',
            'template' => 'page-about-us.php',
            'content'  => '<h2>About Panna Wild Tour</h2><p>Panna Wild Tour is a local travel team helping guests explore Panna Tiger Reserve, nearby waterfalls, and cultural landmarks with smooth planning and responsible tourism practices.</p><h3>What We Do</h3><ul><li>Wildlife safari planning and permit guidance</li><li>Stay coordination with resorts and homestays near Madla gate</li><li>Road transfer support from Khajuraho, Satna, and nearby hubs</li><li>Custom itineraries for families, photographers, and small groups</li></ul><h3>Our Promise</h3><p>We focus on transparent communication, practical local insights, and end-to-end support before and during your trip.</p>',
        ),
        'contact-us' => array(
            'title'    => 'Contact Us',
            'template' => 'page-contact-us.php',
            'content'  => '<h2>Get In Touch</h2><p>For safari schedules, seasonal availability, or package customization, contact our team directly.</p><p><strong>Office:</strong> Near Madla Safari Gate, Panna, Madhya Pradesh</p><p><strong>Phone:</strong> +91 98765 43210<br><strong>Email:</strong> info@pannawildtour.com</p><p>Share your travel dates and group size to receive a suitable plan quickly.</p>',
        ),
        'services' => array(
            'title'    => 'Services',
            'template' => 'page-services.php',
            'content'  => '<h2>Travel Services In Panna</h2><p>We provide complete wildlife-tour support designed around comfort, safety, and local expertise.</p><ul><li>Safari and permit planning</li><li>Accommodation recommendations</li><li>Vehicle and transfer arrangement</li><li>Flexible private tours</li><li>On-ground support during your stay</li></ul><p>Whether you are visiting for a day safari or a multi-day wildlife holiday, we can tailor the route and schedule.</p>',
        ),
        'attractions' => array(
            'title'    => 'Attractions',
            'template' => 'page-attractions.php',
            'content'  => '<h2>Attractions Around Panna</h2><p>Panna offers rich biodiversity, dramatic landscapes, and heritage experiences around the Ken river valley.</p><ul><li><strong>Panna Tiger Reserve</strong> for tiger and wildlife sightings</li><li><strong>Ken River belt</strong> for scenic viewpoints</li><li><strong>Raneh and nearby falls</strong> for unique geological formations</li><li><strong>Temple circuits</strong> connecting regional heritage sites</li></ul><p>Plan a balanced mix of safari drives and local attractions for the best experience.</p>',
        ),
        'booking' => array(
            'title'    => 'Booking',
            'template' => 'page-booking.php',
            'content'  => '<h2>Book Your Panna Tour</h2><p>Use this page to submit your preferred date, package interest, and contact details. Our team reviews each request and confirms availability quickly.</p><p><strong>Tip:</strong> During peak season, share flexible date options for faster confirmation.</p>',
        ),
        'more-information' => array(
            'title'    => 'More Information',
            'template' => 'page-more-information.php',
            'content'  => '<h2>Travel Updates and Planning Notes</h2><p>Read practical guides, seasonal safari tips, packing checklists, and destination updates before your journey.</p><p>New visitors can start with our suggested 2-night and 3-night itinerary ideas for Panna and nearby attractions.</p>',
        ),
    );
}

function panna_wildtour_create_default_pages() {
    $seed_version = 2;
    $option_key   = 'pwt_default_pages_seed_version';

    if ( (int) get_option( $option_key, 0 ) >= $seed_version ) {
        return;
    }

    $legacy_content = array(
        'Learn about Panna Wild Tour, our mission, team and how we help visitors experience the Panna jungles.',
        'Get in touch with us for bookings, queries and support.',
        'Explore our guided safaris, logistics, on-demand and special services around Panna.',
        'Highlights around Panna: Panna Tiger Reserve, Ken river, waterfalls, plateaus and local temples.',
        'Book your safari package. Use the booking page to select packages and submit your details.',
        'Read our latest posts and wildlife stories from Panna.',
    );

    foreach ( panna_wildtour_default_page_blueprint() as $slug => $data ) {
        $page = get_page_by_path( $slug );

        if ( ! $page ) {
            $page_id = wp_insert_post( array(
                'post_title'   => wp_strip_all_tags( $data['title'] ),
                'post_name'    => $slug,
                'post_content' => $data['content'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
            ) );

            if ( $page_id && ! is_wp_error( $page_id ) ) {
                update_post_meta( $page_id, '_wp_page_template', $data['template'] );
            }

            continue;
        }

        $current = trim( wp_strip_all_tags( (string) $page->post_content ) );
        if ( '' === $current || in_array( $current, $legacy_content, true ) ) {
            wp_update_post( array(
                'ID'           => $page->ID,
                'post_content' => $data['content'],
            ) );
        }

        $current_template = get_page_template_slug( $page->ID );
        if ( empty( $current_template ) || 'default' === $current_template ) {
            update_post_meta( $page->ID, '_wp_page_template', $data['template'] );
        }
    }

    update_option( $option_key, $seed_version );
}
add_action( 'after_switch_theme', 'panna_wildtour_create_default_pages' );

function panna_wildtour_seed_default_posts() {
    $option_key = 'pwt_default_posts_seeded';
    if ( get_option( $option_key ) ) {
        return;
    }

    $posts = array(
        array(
            'title'   => 'Best Time To Visit Panna Tiger Reserve',
            'content' => '<p>The ideal season for wildlife viewing in Panna is typically from October to June, with excellent visibility in dry months. Morning safari slots are usually preferred for cooler weather and active movement.</p><h3>Quick Planning Tips</h3><ul><li>Book safari permits in advance during weekends and holidays</li><li>Carry neutral clothing and comfortable walking shoes</li><li>Keep buffer time for entry formalities</li></ul>',
        ),
        array(
            'title'   => '2-Night Panna Itinerary For Families',
            'content' => '<p>A practical family plan includes one evening safari, one morning safari, and one local sightseeing session around waterfalls or temple points near Panna.</p><ol><li>Day 1: Arrival and local orientation</li><li>Day 2: Morning safari and evening leisure</li><li>Day 3: Short attraction visit and departure</li></ol>',
        ),
        array(
            'title'   => 'Safari Checklist Before You Travel',
            'content' => '<p>Before your trip, keep identity documents ready, confirm reporting time, and carry sun protection, water, and a light layer for early morning drives.</p><p>For photographers, a bean bag and protective dust cover are useful additions in open gypsy rides.</p>',
        ),
    );

    foreach ( $posts as $post ) {
        if ( get_page_by_title( $post['title'], OBJECT, 'post' ) ) {
            continue;
        }

        wp_insert_post( array(
            'post_title'   => $post['title'],
            'post_content' => $post['content'],
            'post_status'  => 'publish',
            'post_type'    => 'post',
        ) );
    }

    update_option( $option_key, 1 );
}
add_action( 'after_switch_theme', 'panna_wildtour_seed_default_posts' );

function panna_wildtour_seed_term( $taxonomy, $name, $slug = '' ) {
    if ( ! taxonomy_exists( $taxonomy ) ) {
        return 0;
    }

    $existing = get_term_by( 'name', $name, $taxonomy );
    if ( $existing && ! is_wp_error( $existing ) ) {
        return (int) $existing->term_id;
    }

    $result = wp_insert_term(
        $name,
        $taxonomy,
        array(
            'slug' => $slug ? sanitize_title( $slug ) : sanitize_title( $name ),
        )
    );

    if ( is_wp_error( $result ) ) {
        return 0;
    }

    return (int) $result['term_id'];
}

function panna_wildtour_seed_cpt_entry( $post_type, $title, $content, $excerpt = '', $meta = array(), $tax_terms = array() ) {
    if ( ! post_type_exists( $post_type ) ) {
        return 0;
    }

    $existing = get_posts(
        array(
            'post_type'      => $post_type,
            'title'          => $title,
            'post_status'    => array( 'publish', 'draft', 'pending' ),
            'posts_per_page' => 1,
            'fields'         => 'ids',
        )
    );

    if ( ! empty( $existing ) ) {
        return (int) $existing[0];
    }

    $post_id = wp_insert_post(
        array(
            'post_title'   => $title,
            'post_content' => $content,
            'post_excerpt' => $excerpt,
            'post_status'  => 'publish',
            'post_type'    => $post_type,
        )
    );

    if ( ! $post_id || is_wp_error( $post_id ) ) {
        return 0;
    }

    update_post_meta( $post_id, '_pwt_seed_entry', '1' );

    foreach ( $meta as $key => $value ) {
        update_post_meta( $post_id, $key, $value );
    }

    foreach ( $tax_terms as $taxonomy => $term_ids ) {
        if ( taxonomy_exists( $taxonomy ) && ! empty( $term_ids ) ) {
            wp_set_object_terms( $post_id, array_map( 'absint', (array) $term_ids ), $taxonomy );
        }
    }

    return (int) $post_id;
}

function panna_wildtour_seed_production_cpts() {
    $option_key = 'pwt_production_cpts_seeded';
    if ( get_option( $option_key ) ) {
        return;
    }

    if ( ! post_type_exists( 'pwt_package' ) ) {
        return;
    }

    $season_winter = panna_wildtour_seed_term( 'pwt_season', 'Winter', 'winter' );
    $season_summer = panna_wildtour_seed_term( 'pwt_season', 'Summer', 'summer' );
    $season_monsoon = panna_wildtour_seed_term( 'pwt_season', 'Monsoon', 'monsoon' );

    $activity_safari = panna_wildtour_seed_term( 'pwt_activity', 'Jungle Safari', 'jungle-safari' );
    $activity_birding = panna_wildtour_seed_term( 'pwt_activity', 'Bird Watching', 'bird-watching' );
    $activity_culture = panna_wildtour_seed_term( 'pwt_activity', 'Local Heritage', 'local-heritage' );

    $pkg_family = panna_wildtour_seed_term( 'pwt_package_category', 'Family Package', 'family-package' );
    $pkg_photo = panna_wildtour_seed_term( 'pwt_package_category', 'Photography Package', 'photography-package' );

    $zone_madla = panna_wildtour_seed_term( 'pwt_safari_zone', 'Madla Zone', 'madla-zone' );
    $zone_hinauta = panna_wildtour_seed_term( 'pwt_safari_zone', 'Hinauta Zone', 'hinauta-zone' );

    $vehicle_gypsy = panna_wildtour_seed_term( 'pwt_vehicle_type', 'Gypsy', 'gypsy' );
    $vehicle_canter = panna_wildtour_seed_term( 'pwt_vehicle_type', 'Canter', 'canter' );

    $dest_core = panna_wildtour_seed_term( 'pwt_destination_category', 'Core Forest', 'core-forest' );
    $dest_waterfall = panna_wildtour_seed_term( 'pwt_destination_category', 'Waterfall Trail', 'waterfall-trail' );

    panna_wildtour_seed_cpt_entry(
        'pwt_package',
        '2N/3D Panna Tiger Reserve Family Escape',
        '<p>A practical family-focused itinerary with one evening and one morning safari, comfortable stay near Madla gate, and optional local sightseeing.</p><ul><li>2 nights stay with breakfast</li><li>Guided safari planning support</li><li>On-ground coordination for entry and timings</li></ul>',
        'A complete 2-night Panna plan for families with balanced safari and local visits.',
        array(
            'regular_price' => '14500',
            'offer_price'   => '12900',
            'duration'      => '2 Nights / 3 Days',
        ),
        array(
            'pwt_season'           => array( $season_winter, $season_summer ),
            'pwt_activity'         => array( $activity_safari, $activity_culture ),
            'pwt_package_category' => array( $pkg_family ),
        )
    );

    panna_wildtour_seed_cpt_entry(
        'pwt_package',
        '3N/4D Panna Wildlife and Birding Explorer',
        '<p>Designed for nature lovers and photographers, this package combines multiple safari windows with birding-friendly early departures and scenic river-edge movement.</p><ul><li>3 nights stay options</li><li>Morning and evening safari blocks</li><li>Birding and landscape add-on recommendations</li></ul>',
        'Longer wildlife plan ideal for repeat sightings and birding-focused travel.',
        array(
            'regular_price' => '22800',
            'offer_price'   => '20900',
            'duration'      => '3 Nights / 4 Days',
        ),
        array(
            'pwt_season'           => array( $season_winter, $season_monsoon ),
            'pwt_activity'         => array( $activity_safari, $activity_birding ),
            'pwt_package_category' => array( $pkg_photo ),
        )
    );

    panna_wildtour_seed_cpt_entry(
        'pwt_safari',
        'Sunrise Tiger Trail - Madla Zone',
        '<p>Early morning safari window from Madla gate, suitable for first-time guests who want core jungle movement and strong sighting potential.</p>',
        'Morning safari experience from Madla gate with high wildlife activity window.',
        array(),
        array(
            'pwt_season'       => array( $season_winter, $season_summer ),
            'pwt_vehicle_type' => array( $vehicle_gypsy ),
            'pwt_safari_zone'  => array( $zone_madla ),
        )
    );

    panna_wildtour_seed_cpt_entry(
        'pwt_safari',
        'Evening Forest Drift - Hinauta Zone',
        '<p>A calmer afternoon-to-evening safari run through mixed terrain and waterline sections where movement often improves before sunset.</p>',
        'Evening safari route suited for relaxed viewing and photography light.',
        array(),
        array(
            'pwt_season'       => array( $season_winter, $season_monsoon ),
            'pwt_vehicle_type' => array( $vehicle_canter ),
            'pwt_safari_zone'  => array( $zone_hinauta ),
        )
    );

    panna_wildtour_seed_cpt_entry(
        'pwt_destination',
        'Ken River Viewpoint Circuit',
        '<p>A scenic circuit featuring river-edge viewpoints and forest transitions, recommended as a half-day extension around core safari bookings.</p>',
        'Scenic river and forest-edge route ideal for slow-paced exploration.',
        array(),
        array(
            'pwt_activity'             => array( $activity_birding, $activity_culture ),
            'pwt_destination_category' => array( $dest_core ),
        )
    );

    panna_wildtour_seed_cpt_entry(
        'pwt_destination',
        'Raneh Falls and Canyon Edge Trail',
        '<p>A popular natural extension to Panna trips featuring unique rock formations and seasonal water-flow visual points.</p>',
        'A geological and landscape highlight often combined with safari weekends.',
        array(),
        array(
            'pwt_activity'             => array( $activity_culture ),
            'pwt_destination_category' => array( $dest_waterfall ),
        )
    );

    panna_wildtour_seed_cpt_entry(
        'pwt_resort',
        'Madla Forest Edge Homestay',
        '<p>A budget-friendly homestay option near major safari departure points. Ideal for short-notice and weekend wildlife plans.</p>',
        'Comfortable local stay near Madla gate with practical safari access.'
    );

    panna_wildtour_seed_cpt_entry(
        'pwt_resort',
        'Ken Riverside Nature Lodge',
        '<p>A mid-range lodge with easy transfer support and flexible meal plans suitable for families and small wildlife groups.</p>',
        'Riverside stay option balancing comfort, access, and value.'
    );

    panna_wildtour_seed_cpt_entry(
        'pwt_vehicle',
        'Private Gypsy - 6 Seater',
        '<p>Dedicated gypsy option for families and small groups looking for flexible movement and personalized safari pacing.</p>',
        'Private gypsy for focused wildlife drives.',
        array(),
        array(
            'pwt_vehicle_type' => array( $vehicle_gypsy ),
        )
    );

    panna_wildtour_seed_cpt_entry(
        'pwt_vehicle',
        'Shared Canter - 20 Seater',
        '<p>Cost-effective shared canter option for larger groups and fixed-slot safari timings.</p>',
        'Shared safari canter for budget-focused travelers.',
        array(),
        array(
            'pwt_vehicle_type' => array( $vehicle_canter ),
        )
    );

    panna_wildtour_seed_cpt_entry(
        'pwt_faq',
        'What is the best month to visit Panna Tiger Reserve?',
        '<p>October to June is generally preferred. Winter offers comfort and clear mornings, while summer can improve big-cat movement near water zones.</p>'
    );

    panna_wildtour_seed_cpt_entry(
        'pwt_faq',
        'How early should safari bookings be made?',
        '<p>For weekends and holiday periods, we recommend planning at least 2-4 weeks in advance to improve slot availability.</p>'
    );

    panna_wildtour_seed_cpt_entry(
        'pwt_testimonial',
        'Smooth planning and responsive local support',
        '<p>Our family trip was coordinated end-to-end. The team guided us on gate timing, stay, and transfers, and communication remained clear throughout.</p>'
    );

    panna_wildtour_seed_cpt_entry(
        'pwt_review',
        'Great safari pacing for first-time visitors',
        '<p>Excellent first Panna experience with practical itinerary pacing and timely support at every step.</p>',
        '',
        array(
            'rating'    => '5',
            'verified'  => '1',
            'guest_city'=> 'Bhopal',
        )
    );

    update_option( $option_key, 1 );
}
add_action( 'after_switch_theme', 'panna_wildtour_seed_production_cpts' );

function panna_wildtour_run_seeders_once_in_admin() {
    if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
        return;
    }

    panna_wildtour_create_default_pages();
    panna_wildtour_seed_default_posts();
    panna_wildtour_seed_production_cpts();
}
add_action( 'admin_init', 'panna_wildtour_run_seeders_once_in_admin' );

function panna_wildtour_seeded_cpt_count() {
    $seed_types = array( 'pwt_package', 'pwt_safari', 'pwt_destination', 'pwt_resort', 'pwt_vehicle', 'pwt_faq', 'pwt_testimonial', 'pwt_review' );

    $query = new WP_Query(
        array(
            'post_type'      => $seed_types,
            'post_status'    => array( 'publish', 'draft', 'pending' ),
            'posts_per_page' => 100,
            'fields'         => 'ids',
            'meta_key'       => '_pwt_seed_entry',
            'meta_value'     => '1',
            'no_found_rows'  => false,
        )
    );

    return (int) $query->found_posts;
}

function panna_wildtour_register_reseed_page() {
    add_theme_page(
        esc_html__( 'Reseed CPT Samples', 'panna-wildtour' ),
        esc_html__( 'Reseed CPT Samples', 'panna-wildtour' ),
        'manage_options',
        'pwt-reseed-cpt-samples',
        'panna_wildtour_render_reseed_page'
    );
}
add_action( 'admin_menu', 'panna_wildtour_register_reseed_page' );

function panna_wildtour_render_reseed_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $message = '';

    if ( isset( $_POST['pwt_reseed_cpt_samples'] ) ) {
        check_admin_referer( 'pwt_reseed_cpt_samples_action', 'pwt_reseed_cpt_samples_nonce' );

        delete_option( 'pwt_production_cpts_seeded' );
        panna_wildtour_seed_production_cpts();

        $message = esc_html__( 'CPT sample seeding has been executed.', 'panna-wildtour' );
    }

    $count = panna_wildtour_seeded_cpt_count();
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Reseed CPT Samples', 'panna-wildtour' ); ?></h1>
        <p><?php esc_html_e( 'Use this tool to re-run production sample seeding for plugin CPT entries and taxonomies.', 'panna-wildtour' ); ?></p>
        <?php if ( $message ) : ?>
            <div class="notice notice-success is-dismissible"><p><?php echo esc_html( $message ); ?></p></div>
        <?php endif; ?>
        <p><strong><?php esc_html_e( 'Current seeded entry count:', 'panna-wildtour' ); ?></strong> <?php echo esc_html( (string) $count ); ?></p>
        <form method="post">
            <?php wp_nonce_field( 'pwt_reseed_cpt_samples_action', 'pwt_reseed_cpt_samples_nonce' ); ?>
            <p>
                <button type="submit" name="pwt_reseed_cpt_samples" class="button button-primary">
                    <?php esc_html_e( 'Reseed CPT Samples', 'panna-wildtour' ); ?>
                </button>
            </p>
        </form>
    </div>
    <?php
}
