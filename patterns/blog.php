<?php

return [
    'title'      => __('Blog', 'panna-wildtour'),
    'categories'  => ['blog'],
    'content'     => '

<!-- wp:group {"className":"section blog section--alt","layout":{"type":"constrained"}} -->
<div class="wp-block-group section blog section--alt">

<!-- wp:heading {"level":2} -->
<h2>Latest News</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Stay updated with recent stories from Panna, safari news, and visitor experiences.</p>
<!-- /wp:paragraph -->

<!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[""],"sticky":""},"displayLayout":{"type":"list","columns":3}} -->
<div class="wp-block-query">
<!-- wp:post-template -->
<!-- wp:post-title {"level":3} /-->
<!-- /wp:post-template -->
</div>
<!-- /wp:query -->

</div>
<!-- /wp:group -->

'
];