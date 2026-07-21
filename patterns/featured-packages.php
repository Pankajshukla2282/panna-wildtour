<?php

return [
    'title'      => __('Featured Packages', 'panna-wildtour'),
    'categories'  => ['featured'],
    'content'     => '

<!-- wp:group {"className":"section featured-packages","layout":{"type":"constrained"}} -->
<div class="wp-block-group section featured-packages">

<!-- wp:heading {"level":2} -->
<h2>Featured Safari Packages</h2>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns">

<!-- wp:column -->
<div class="wp-block-column package-card">
<!-- wp:heading {"level":3} -->
<h3>Morning Jeep Safari</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Experience the first light on the Panna jungles with an expert guide. Ideal for wildlife sightings and photography.</p>
<!-- /wp:paragraph -->
<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link" href="/booking/">Book Now</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column package-card">
<!-- wp:heading {"level":3} -->
<h3>Overnight Jungle Stay</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Stay close to nature in a comfortable camp or lodge near the park, with guided safaris and local cuisine.</p>
<!-- /wp:paragraph -->
<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link" href="/booking/">Book Now</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column package-card">
<!-- wp:heading {"level":3} -->
<h3>Custom Wildlife Tour</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Create a personalized itinerary with our local team for photography, birding, and cultural exploration in Panna.</p>
<!-- /wp:paragraph -->
<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link" href="/booking/">Book Now</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:column -->

</div>

</div>
<!-- /wp:group -->

'
];