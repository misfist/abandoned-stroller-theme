<?php
/**
 * Lightbox overlay output for the Abandoned Stroller theme.
 *
 * Outputs the lightbox overlay HTML to the footer. The overlay is server-
 * rendered but hidden by default; the Interactivity API controls visibility
 * and populates it with per-post data when a post image is clicked.
 */

namespace Abandoned_Stroller;

/**
 * Output the lightbox overlay HTML.
 *
 * The element starts hidden. data-wp-class--is-open toggles visibility via CSS.
 * All content is bound to global state, populated by the openLightbox action.
 * data-wp-on-document--keydown wires arrow key navigation and Escape to close.
 *
 * @return void
 */
function render_lightbox_overlay(): void {
	if ( ! is_home() && ! is_archive() && ! is_search() ) {
		return;
	}

	?>
	<div
		class="lightbox"
		data-wp-interactive="abandoned-stroller"
		data-wp-class--is-open="state.isOpen"
		data-wp-bind--aria-hidden="!state.isOpen"
		data-wp-on-document--keydown="actions.handleKeydown"
		role="dialog"
		aria-modal="true"
		aria-label="<?php esc_attr_e( 'Image Lightbox', 'abandoned-stroller' ); ?>"
		aria-hidden="true"
	>
		<div class="lightbox__backdrop" data-wp-on--click="actions.closeLightbox"></div>

		<div class="lightbox__content">

			<button
				class="lightbox__close"
				data-wp-on--click="actions.closeLightbox"
				aria-label="<?php esc_attr_e( 'Close lightbox', 'abandoned-stroller' ); ?>"
			><?php esc_html_e( 'Close', 'abandoned-stroller' ); ?></button>

			<figure class="lightbox__figure">
				<img
					class="lightbox__image"
					data-wp-bind--src="state.imageUrl"
					data-wp-bind--alt="state.title"
					src=""
					alt=""
				/>
				<figcaption class="lightbox__caption" data-wp-text="state.caption"></figcaption>
			</figure>

			<div class="lightbox__info">

				<h2 class="lightbox__title" data-wp-text="state.title"></h2>

				<div class="lightbox__meta">
					<time class="lightbox__date" data-wp-text="state.date"></time>

					<ul class="lightbox__categories">
						<template data-wp-each="state.categories">
							<li><a data-wp-bind--href="context.item.url" data-wp-text="context.item.name"></a></li>
						</template>
					</ul>

					<ul class="lightbox__tags">
						<template data-wp-each="state.tags">
							<li><a data-wp-bind--href="context.item.url" data-wp-text="context.item.name"></a></li>
						</template>
					</ul>
				</div>

				<a
					class="lightbox__permalink"
					data-wp-bind--href="state.permalink"
					href="#"
				><?php esc_html_e( 'View Post', 'abandoned-stroller' ); ?></a>

			</div>

			<nav class="lightbox__nav" aria-label="<?php esc_attr_e( 'Post navigation', 'abandoned-stroller' ); ?>">
				<button
					class="lightbox__prev"
					data-wp-on--click="actions.prevPost"
					aria-label="<?php esc_attr_e( 'Previous post', 'abandoned-stroller' ); ?>"
				>&larr;</button>

				<span class="lightbox__count" data-wp-text="state.countLabel"></span>

				<button
					class="lightbox__next"
					data-wp-on--click="actions.nextPost"
					aria-label="<?php esc_attr_e( 'Next post', 'abandoned-stroller' ); ?>"
				>&rarr;</button>
			</nav>

		</div>

	</div>
	<?php
}
add_action( 'wp_footer', __NAMESPACE__ . '\render_lightbox_overlay' );
