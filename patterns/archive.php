<?php
/**
 * Title: Archive
 * Slug: abandonedstroller/archive
 * Inserter: no
 */
?>
<!-- wp:template-part {"slug":"header"} /-->

<!-- wp:group {"tagName":"main","className":"main-content","style":{"spacing":{"padding":{"top":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group main-content" style="padding-top:var(--wp--preset--spacing--60)">
    <!-- wp:query-title {"type":"archive","showPrefix":false,"align":"wide"} /-->

    <!-- wp:term-description {"align":"wide"} /-->

    <!-- wp:pattern {"slug":"abandonedstroller/post-grid"} /-->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer"} /-->