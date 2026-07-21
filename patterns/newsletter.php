<?php

return [
    'title'      => __('Newsletter', 'panna-wildtour'),
    'categories'  => ['newsletter'],
    'content'     => '

<!-- wp:group {"className":"section newsletter","layout":{"type":"constrained"}} -->
<div class="wp-block-group section newsletter">

<!-- wp:heading {"level":2} -->
<h2>Newsletter</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Get the latest safari updates, seasonal tours, and travel tips directly to your inbox.</p>
<!-- /wp:paragraph -->
<!-- wp:shortcode -->
[fluentform id="2"]
<!-- /wp:shortcode -->

</div>
<!-- /wp:group -->

'
];