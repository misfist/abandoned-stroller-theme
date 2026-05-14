<?php
/**
 * Title: Post Grid
 * Slug: abandoned-stroller/post-grid
 * Categories: Posts
 * Blocks: core/query
 * Inserter: true
 */
?>
<!-- wp:query {
    "queryId": 1,
    "query": {
        "perPage": 25,
        "pages": 0,
        "offset": 0,
        "postType": "post",
        "order": "desc",
        "orderBy": "date",
        "author": "",
        "search": "",
        "exclude": [],
        "sticky": "",
        "inherit": true,
        "taxQuery": null,
        "parents": []
    },
    "align": "wide",
    "layout": {
        "type": "default"
    }
} -->
<div class="wp-block-query alignwide">
    <!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
     
        <!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/2"} /-->

        <!-- wp:group {"metadata":{"name":"Post Body"},"className":"wp-block-post-body","layout":{"type":"default"}} -->
        <div class="wp-block-group wp-block-post-body">
            <!-- wp:post-title {"isLink":true} /-->

            <!-- wp:pattern {"slug":"abandoned-stroller/post-meta"} /-->
        </div>
        <!-- /wp:group -->
    <!-- /wp:post-template -->

    <!-- wp:group {"metadata":{"name":"No Posts"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
        <!-- wp:query-no-results -->
        <!-- wp:paragraph -->
        <p><?php esc_html_e( 'Sorry, but nothing was found. Please try a search with different keywords.', 'abandoned-stroller' ); ?></p>
        <!-- /wp:paragraph -->
        <!-- /wp:query-no-results -->
    </div>
    <!-- /wp:group -->

    <!-- wp:group {"metadata":{"name":"Pagination"},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group">
        <!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"space-between"}} -->
            <!-- wp:query-pagination-previous /-->

            <!-- wp:query-pagination-numbers /-->

            <!-- wp:query-pagination-next /-->
        <!-- /wp:query-pagination -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:query -->