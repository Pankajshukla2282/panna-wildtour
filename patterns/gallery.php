<?php

return [
    'title'      => __('Gallery', 'panna-wildtour'),
    'categories'  => ['gallery'],
    'content'     => '

<!-- wp:group {"className":"section gallery section--alt","layout":{"type":"constrained"}} -->
<div class="wp-block-group section gallery section--alt">

<!-- wp:heading {"level":2} -->
<h2>Gallery</h2>
<!-- /wp:heading -->

<!-- wp:gallery {"linkTo":"none"} -->
<figure class="wp-block-gallery columns-3">
<figure class="blocks-gallery-item"><img src="/wp-content/uploads/2020/10/DSC_2678-1024x681.jpg" alt=""></figure>
<figure class="blocks-gallery-item"><img src="/wp-content/uploads/2020/10/DSCN0532-1024x768.jpg" alt=""></figure>
<figure class="blocks-gallery-item"><img src="/wp-content/uploads/2020/10/DSC_2678-1024x681.jpg" alt=""></figure>
</figure>
<!-- /wp:gallery -->

</div>
<!-- /wp:group -->

'
];