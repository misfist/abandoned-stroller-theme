<?php
/**
 * Lightbox state and context injection for the Abandoned Stroller theme.
 *
 * Initialises the Interactivity API store state and injects per-post context
 * into each post <li> rendered by core/post-template.
 */

namespace Abandoned_Stroller;

/**
 * Map a WP_Term to a name/url array for use in lightbox context.
 *
 * @param \WP_Term $term The term to map.
 * @return array
 */
function map_term_to_context_item( \WP_Term $term ): array {
	return array(
		'name' => $term->name,
		'url'  => get_term_link( $term ),
	);
}

/**
 * Build the lightbox context array for a given post.
 *
 * @param int $post_id Post ID.
 * @return array
 */
function get_post_lightbox_context( int $post_id ): array {
	$image_url  = get_the_post_thumbnail_url( $post_id, 'large' ) ?: '';
	$categories = array_map( __NAMESPACE__ . '\map_term_to_context_item', get_the_category( $post_id ) );
	$tags       = array_map( __NAMESPACE__ . '\map_term_to_context_item', get_the_tags( $post_id ) ?: array() );

	return array(
		'imageUrl'   => $image_url,
		'title'      => html_entity_decode( get_the_title( $post_id ), ENT_QUOTES | ENT_HTML5, 'UTF-8' ),
		'permalink'  => get_permalink( $post_id ),
		'date'       => get_the_date( '', $post_id ),
		'categories' => $categories,
		'tags'       => $tags,
	);
}

/**
 * Initialise the global lightbox state server-side.
 *
 * The Interactivity API serialises this into the page so the JS store can
 * read it without an extra request.
 *
 * @return void
 */
function init_lightbox_state(): void {
	$state = array(
		'isOpen'       => false,
		'imageUrl'     => '',
		'title'        => '',
		'permalink'    => '',
		'date'         => '',
		'categories'   => array(),
		'tags'         => array(),
		'posts'        => array(),
		'currentIndex' => 0,
		'total'        => 0,
	);

	wp_interactivity_state( 'abandoned-stroller', $state );
}
add_action( 'wp_footer', __NAMESPACE__ . '\init_lightbox_state', 1 );

/**
 * Inject data-wp-interactive and data-wp-context into each post <li>.
 *
 * Filters core/post-template output. Uses WP_HTML_Tag_Processor to walk each
 * wp-block-post <li>, extracts the post ID from its class attribute (WordPress
 * adds a post-{id} class via get_post_class()), then injects the lightbox
 * context for that post.
 *
 * @param string $block_content Rendered HTML for the block.
 * @param array  $block         Block data including blockName.
 * @return string
 */
function inject_post_template_lightbox_context( string $block_content, array $block ): string {
	if ( 'core/post-template' !== $block['blockName'] ) {
		return $block_content;
	}

	$processor = new \WP_HTML_Tag_Processor( $block_content );

	while ( $processor->next_tag(
		array(
			'tag_name'   => 'li',
			'class_name' => 'wp-block-post',
		)
	) ) {
		$classes = $processor->get_attribute( 'class' );

		if ( null === $classes || ! preg_match( '/\bpost-(\d+)\b/', $classes, $matches ) ) {
			continue;
		}

		$post_id = (int) $matches[1];
		$context = get_post_lightbox_context( $post_id );

		$processor->set_attribute( 'data-wp-interactive', 'abandoned-stroller' );
		$processor->set_attribute( 'data-wp-context', wp_json_encode( $context ) );
	}

	return $processor->get_updated_html();
}
add_filter( 'render_block', __NAMESPACE__ . '\inject_post_template_lightbox_context', 10, 2 );

/**
 * Inject the lightbox click handler onto post-level clickable blocks.
 *
 * Both the featured image and the post title should open the lightbox.
 * The openLightbox action reads context from the nearest ancestor with
 * data-wp-context — the <li> injected by inject_post_template_lightbox_context.
 *
 * @param string $block_content Rendered HTML for the block.
 * @param array  $block         Block data including blockName.
 * @return string
 */
function inject_post_item_click_handler( string $block_content, array $block ): string {
	$clickable_blocks = array(
		'core/post-featured-image',
		'core/post-title',
	);

	if ( ! in_array( $block['blockName'], $clickable_blocks, true ) ) {
		return $block_content;
	}

	$processor = new \WP_HTML_Tag_Processor( $block_content );

	if ( $processor->next_tag( 'a' ) ) {
		$processor->set_attribute( 'data-wp-on--click', 'actions.openLightbox' );
	}

	return $processor->get_updated_html();
}
add_filter( 'render_block', __NAMESPACE__ . '\inject_post_item_click_handler', 10, 2 );
