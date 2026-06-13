import { store, getContext } from '@wordpress/interactivity';

function applyPostAtIndex( state, index ) {
	const post = state.posts[ index ];

	if ( ! post ) {
		return;
	}

	state.imageUrl     = post.imageUrl;
	state.title        = post.title;
	state.permalink    = post.permalink;
	state.date         = post.date;
	state.caption      = post.caption;
	state.categories   = post.categories;
	state.tags         = post.tags;
	state.currentIndex = index;
}

const { state } = store( 'abandoned-stroller', {
	state: {
		get countLabel() {
			return ( state.currentIndex + 1 ) + ' / ' + state.total;
		},
	},
	actions: {
		openLightbox( event ) {
			event.preventDefault();

			const context = getContext();

			state.posts = Array.from(
				document.querySelectorAll( '.wp-block-post[data-wp-context]' )
			).map( ( el ) => JSON.parse( el.dataset.wpContext ) );

			state.total = state.posts.length;

			const index = state.posts.findIndex( ( post ) => post.permalink === context.permalink );

			applyPostAtIndex( state, index >= 0 ? index : 0 );
			state.isOpen = true;
		},

		closeLightbox() {
			state.isOpen = false;
		},

		nextPost() {
			if ( state.total < 2 ) {
				return;
			}

			applyPostAtIndex( state, ( state.currentIndex + 1 ) % state.total );
		},

		prevPost() {
			if ( state.total < 2 ) {
				return;
			}

			applyPostAtIndex( state, ( state.currentIndex - 1 + state.total ) % state.total );
		},

		handleKeydown( event ) {
			if ( ! state.isOpen ) {
				return;
			}

			if ( 'Escape' === event.key ) {
				state.isOpen = false;
			} else if ( state.total < 2 ) {
				return;
			} else if ( 'ArrowRight' === event.key ) {
				applyPostAtIndex( state, ( state.currentIndex + 1 ) % state.total );
			} else if ( 'ArrowLeft' === event.key ) {
				applyPostAtIndex( state, ( state.currentIndex - 1 + state.total ) % state.total );
			}
		},
	},
} );
