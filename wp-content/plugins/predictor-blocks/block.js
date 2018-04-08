( function( blocks, element ) {
	var el = element.createElement;

	function Stars( { stars } ) {
		return el( 'div', { key: 'stars' },
			'★'.repeat( stars ),
			( ( stars * 2 ) % 2 ) ? '½' : '' );
	}

	blocks.registerBlockType( 'stars/stars-block', {
		title: 'Stars Block',

		icon: 'format-image',

		category: 'common',

		attributes: {
			stars: {
				type: 'int',
				meta: 'stars', // Store the value in postmeta
			}
		},

		edit: function( props ) {
			var stars = props.attributes.stars,
				children = [];

			function setStars( event ) {
				props.setAttributes( { stars: event.target.value } );
				event.preventDefault();
			}

			if ( stars ) {
				children.push( Stars( { stars: stars } ) );
			}

			children.push(
				el( 'input', {
					key: 'stars-input',
					type: 'number',
					min: 0,
					max: 5,
					step: 0.5,
					value: stars,
					onChange: setStars } )
			);

			return el( 'form', { onSubmit: setStars }, children );
		},

		save: function() {
			// We don't want to save any HTML in post_content, as the value will be in postmeta
			return null;
		}
	} );
} )(
	window.wp.blocks,
	window.wp.element
);
