<?php
/**
 * Block features and editor enhancements for the child theme.
 *
 * @package wildtours-plugin
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * Register block styles and block patterns used across marketing pages.
 */
function pwt_child_register_block_features(): void
{
    if (function_exists('register_block_style')) {
        register_block_style(
            'core/group',
            [
                'name'  => 'pwt-surface-card',
                'label' => __('PWT Surface Card', 'wildtours-plugin'),
            ]
        );

        register_block_style(
            'core/columns',
            [
                'name'  => 'pwt-feature-grid',
                'label' => __('PWT Feature Grid', 'wildtours-plugin'),
            ]
        );

        register_block_style(
            'core/buttons',
            [
                'name'  => 'pwt-cta-row',
                'label' => __('PWT CTA Row', 'wildtours-plugin'),
            ]
        );
    }

    if (!function_exists('register_block_pattern')) {
        return;
    }

    if (function_exists('register_block_pattern_category')) {
        register_block_pattern_category(
            'pwt-sections',
            [
                'label' => __('PWT Sections', 'wildtours-plugin'),
            ]
        );
    }

    register_block_pattern(
        'pwt/feature-highlights',
        [
            'title'         => __('PWT Feature Highlights', 'wildtours-plugin'),
            'description'   => __('Three-column feature highlights section for service pages.', 'wildtours-plugin'),
            'categories'    => ['pwt-sections', 'columns'],
            'viewportWidth' => 1200,
            'content'       =>
                '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"28px","right":"28px","bottom":"28px","left":"28px"}},"border":{"radius":"20px"}},"backgroundColor":"base","className":"is-style-pwt-surface-card"} -->' .
                '<div class="wp-block-group alignwide is-style-pwt-surface-card has-base-background-color has-background" style="border-radius:20px;padding-top:28px;padding-right:28px;padding-bottom:28px;padding-left:28px">' .
                '<!-- wp:heading {"level":2} --><h2>' . esc_html__('Why Choose Panna Wild Tour', 'wildtours-plugin') . '</h2><!-- /wp:heading -->' .
                '<!-- wp:columns {"className":"is-style-pwt-feature-grid"} --><div class="wp-block-columns is-style-pwt-feature-grid">' .
                '<!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":4} --><h4>' . esc_html__('Trusted Local Experts', 'wildtours-plugin') . '</h4><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__('Guides and hosts with deep local knowledge of Panna Tiger Reserve.', 'wildtours-plugin') . '</p><!-- /wp:paragraph --></div><!-- /wp:column -->' .
                '<!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":4} --><h4>' . esc_html__('Flexible Itineraries', 'wildtours-plugin') . '</h4><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__('Packages tailored for families, photographers, and wildlife enthusiasts.', 'wildtours-plugin') . '</p><!-- /wp:paragraph --></div><!-- /wp:column -->' .
                '<!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":4} --><h4>' . esc_html__('Quick Booking Support', 'wildtours-plugin') . '</h4><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__('Fast confirmations with WhatsApp and phone assistance.', 'wildtours-plugin') . '</p><!-- /wp:paragraph --></div><!-- /wp:column -->' .
                '</div><!-- /wp:columns -->' .
                '</div><!-- /wp:group -->',
        ]
    );

    register_block_pattern(
        'pwt/feature-cta-band',
        [
            'title'         => __('PWT Feature + CTA Band', 'wildtours-plugin'),
            'description'   => __('Feature paragraph with two call-to-action buttons.', 'wildtours-plugin'),
            'categories'    => ['pwt-sections', 'buttons'],
            'viewportWidth' => 1200,
            'content'       =>
                '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"24px","right":"24px","bottom":"24px","left":"24px"}},"border":{"radius":"18px"}},"backgroundColor":"base","className":"is-style-pwt-surface-card"} -->' .
                '<div class="wp-block-group alignwide is-style-pwt-surface-card has-base-background-color has-background" style="border-radius:18px;padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px">' .
                '<!-- wp:heading {"level":3} --><h3>' . esc_html__('Ready to Plan Your Panna Safari?', 'wildtours-plugin') . '</h3><!-- /wp:heading -->' .
                '<!-- wp:paragraph --><p>' . esc_html__('Talk to our team for package options, availability, and custom plans.', 'wildtours-plugin') . '</p><!-- /wp:paragraph -->' .
                '<!-- wp:buttons {"className":"is-style-pwt-cta-row"} --><div class="wp-block-buttons is-style-pwt-cta-row">' .
                '<!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact-us/">' . esc_html__('Contact Team', 'wildtours-plugin') . '</a></div><!-- /wp:button -->' .
                '<!-- wp:button {"className":"is-style-outline"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/booking/">' . esc_html__('Book Now', 'wildtours-plugin') . '</a></div><!-- /wp:button -->' .
                '</div><!-- /wp:buttons -->' .
                '</div><!-- /wp:group -->',
        ]
    );

    register_block_pattern(
        'pwt/safari-package-cards-strip',
        [
            'title'         => __('PWT Safari Package Cards Strip', 'wildtours-plugin'),
            'description'   => __('Compact cards strip powered by plugin package shortcode.', 'wildtours-plugin'),
            'categories'    => ['pwt-sections'],
            'viewportWidth' => 1200,
            'content'       =>
                '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"24px","right":"24px","bottom":"24px","left":"24px"},"blockGap":"14px"},"border":{"radius":"18px"}},"backgroundColor":"base","className":"is-style-pwt-surface-card"} -->' .
                '<div class="wp-block-group alignwide is-style-pwt-surface-card has-base-background-color has-background" style="border-radius:18px;padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px">' .
                '<!-- wp:heading {"level":3} --><h3>' . esc_html__('Safari & Tour Packages', 'wildtours-plugin') . '</h3><!-- /wp:heading -->' .
                '<!-- wp:paragraph --><p>' . esc_html__('Highlight your best itineraries in a quick comparison strip.', 'wildtours-plugin') . '</p><!-- /wp:paragraph -->' .
                '<!-- wp:shortcode -->[pwt_packages]<!-- /wp:shortcode -->' .
                '</div><!-- /wp:group -->',
        ]
    );

    register_block_pattern(
        'pwt/booking-cta-whatsapp',
        [
            'title'         => __('PWT Booking CTA + WhatsApp', 'wildtours-plugin'),
            'description'   => __('Action band with booking and WhatsApp contact CTAs.', 'wildtours-plugin'),
            'categories'    => ['pwt-sections', 'buttons'],
            'viewportWidth' => 1200,
            'content'       =>
                '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"24px","right":"24px","bottom":"24px","left":"24px"}},"border":{"radius":"18px"}},"backgroundColor":"base","className":"is-style-pwt-surface-card"} -->' .
                '<div class="wp-block-group alignwide is-style-pwt-surface-card has-base-background-color has-background" style="border-radius:18px;padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px">' .
                '<!-- wp:columns {"verticalAlignment":"center"} --><div class="wp-block-columns are-vertically-aligned-center">' .
                '<!-- wp:column {"verticalAlignment":"center","width":"68%"} --><div class="wp-block-column is-vertically-aligned-center" style="flex-basis:68%"><!-- wp:heading {"level":3} --><h3>' . esc_html__('Need Instant Booking Help?', 'wildtours-plugin') . '</h3><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__('Talk to our travel desk for package selection, dates, and permit guidance.', 'wildtours-plugin') . '</p><!-- /wp:paragraph --></div><!-- /wp:column -->' .
                '<!-- wp:column {"verticalAlignment":"center","width":"32%"} --><div class="wp-block-column is-vertically-aligned-center" style="flex-basis:32%"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"},"className":"is-style-pwt-cta-row"} --><div class="wp-block-buttons is-style-pwt-cta-row"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/booking/">' . esc_html__('Book Now', 'wildtours-plugin') . '</a></div><!-- /wp:button --><!-- wp:button {"className":"is-style-outline"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="https://wa.me/919000000000" target="_blank" rel="noopener noreferrer">' . esc_html__('WhatsApp Us', 'wildtours-plugin') . '</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div><!-- /wp:column -->' .
                '</div><!-- /wp:columns -->' .
                '</div><!-- /wp:group -->',
        ]
    );

    register_block_pattern(
        'pwt/faq-accordion-plugin',
        [
            'title'         => __('PWT FAQ Accordion (Plugin)', 'wildtours-plugin'),
            'description'   => __('FAQ section using plugin shortcode output to match plugin content.', 'wildtours-plugin'),
            'categories'    => ['pwt-sections'],
            'viewportWidth' => 1200,
            'content'       =>
                '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"24px","right":"24px","bottom":"24px","left":"24px"},"blockGap":"14px"},"border":{"radius":"18px"}},"backgroundColor":"base","className":"is-style-pwt-surface-card"} -->' .
                '<div class="wp-block-group alignwide is-style-pwt-surface-card has-base-background-color has-background" style="border-radius:18px;padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px">' .
                '<!-- wp:heading {"level":3} --><h3>' . esc_html__('Frequently Asked Questions', 'wildtours-plugin') . '</h3><!-- /wp:heading -->' .
                '<!-- wp:paragraph --><p>' . esc_html__('Common safari and package questions answered by our local experts.', 'wildtours-plugin') . '</p><!-- /wp:paragraph -->' .
                '<!-- wp:shortcode -->[pwt_faq]<!-- /wp:shortcode -->' .
                '</div><!-- /wp:group -->',
        ]
    );
}
add_action('init', 'pwt_child_register_block_features');
