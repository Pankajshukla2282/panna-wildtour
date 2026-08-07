<?php
/**
 * Fallback template for the child theme.
 *
 * @package panna-wild-tour
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

get_header();
?>
<main id="primary" class="site-main">
	<?php
	if (have_posts()) {
		while (have_posts()) {
			the_post();
			get_template_part('template-parts/content/content', get_post_type());
		}
	} else {
		get_template_part('template-parts/content/content', 'none');
	}
	?>
</main>
<?php
get_footer();
