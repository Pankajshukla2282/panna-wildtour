<?php
/**
 * Schema and SEO markup for Panna Wild Tour theme.
 *
 * @package Panna_Wild_Tour
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function panna_wildtour_schema_markup() {
    $site_name        = get_bloginfo( 'name' );
    $site_description = get_bloginfo( 'description' );
    $site_url         = get_home_url();
    $upi_id           = get_theme_mod( 'pwt_upi_id', 'pannawildtour@okaxis' );

    $schema = array(
        '@context'        => 'https://schema.org',
        '@graph'          => array(
            array(
                '@type'       => 'Organization',
                '@id'         => trailingslashit( $site_url ) . '#organization',
                'name'        => $site_name,
                'url'         => $site_url,
                'description' => $site_description,
                'logo'        => get_theme_mod( 'custom_logo' ) ? wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' ) : '',
            ),
            array(
                '@type'           => 'TravelAgency',
                '@id'             => trailingslashit( $site_url ) . '#travelagency',
                'name'            => $site_name,
                'description'     => $site_description,
                'url'             => $site_url,
                'telephone'       => get_theme_mod( 'pwt_contact_phone', '+91 98765 43210' ),
                'paymentAccepted' => array( 'Cash', 'UPI', 'Bank Transfer' ),
                'hasOfferCatalog' => array(
                    '@type'    => 'OfferCatalog',
                    'name'     => esc_html__( 'Panna Wild Tour packages', 'panna-wildtour' ),
                    'itemListElement' => array(),
                ),
            ),
        ),
    );

    echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>' . "\n";
}
add_action( 'wp_head', 'panna_wildtour_schema_markup' );
