<?php
/**
 * Title: Single
 * Slug: abandoned-stroller/single
 * Inserter: no
 */
?>
<!-- wp:group {"tagName":"main","className":"main-content","style":{"spacing":{"padding":{"top":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group main-content" style="padding-top:var(--wp--preset--spacing--60)">
    <!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
        <!-- wp:post-title {"level":1} /-->

        <!-- wp:post-featured-image {"aspectRatio":"3/2","isLightbox":true} /-->

        <!-- wp:pattern {"slug":"abandoned-stroller/post-meta"} /-->

        <!-- wp:post-content {"align":"full","layout":{"type":"constrained"}} /-->

        <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:post-terms {"term":"post_tag","separator":"  ","className":"is-style-post-terms-1"} /--></div>
        <!-- /wp:group -->

            <!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"default"}} -->
            <div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--60);margin-bottom:var(--wp--preset--spacing--60)">
                <!-- wp:group {"tagName":"nav","align":"wide","style":{"border":{"top":{"color":"var:preset|color|accent-6","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"},"ariaLabel":"Post navigation"} -->
                <nav class="wp-block-group alignwide" aria-label="Post navigation" style="border-top-color:var(--wp--preset--color--accent-6);border-top-width:1px;padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)">
                    <!-- wp:post-navigation-link {"type":"previous","showTitle":true,"arrow":"arrow"} /-->

                    <!-- wp:post-navigation-link {"showTitle":true,"arrow":"arrow"} /-->
                </nav>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->

    <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
       <!-- wp:pattern {"slug":"twentytwentyfive/more-posts"} /-->
    </div>
    <!-- /wp:group -->
</main>
<!-- /wp:group -->