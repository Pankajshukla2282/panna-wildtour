<?php

return [

    'title'      => __('Booking CTA', 'panna-wildtour'),
    'categories' => ['featured'],
    'content'    => '

<!-- wp:group {"className":"section booking-cta","layout":{"type":"constrained"}} -->
<div class="wp-block-group section booking-cta">

<!-- wp:columns -->
<div class="wp-block-columns">

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:heading {"level":2} -->
<h2>Plan Your Safari</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Reserve your wildlife adventure with ease. Choose your safari, accommodation, and extra services for a complete Panna experience.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link" href="/booking/">Start Booking</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:shortcode -->
[fluentform id="1"]
<!-- /wp:shortcode -->
</div>
<!-- /wp:column -->

</div>
</div>
<!-- /wp:group -->

'
];

