/**
 * Starter Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Theme Name
 */

( function ( $ ) {

	$( document ).ready(function() {

		// Off Canvas Nav.
		$( '.c-toggle' ).on('click', function() {
			slide_off_canvas_menu();
		});

		function slide_off_canvas_menu() {
			if ( $( '.site-wrap' ).hasClass( 'has-visible-menu' ) ) {
				// Do things on Nav Close.
				$( '.site-wrap' ).removeClass( 'has-visible-menu' );
			} else {
				// Do things on Nav Open.
				$( '.site-wrap' ).addClass( 'has-visible-menu' );
			}
		}
	});
} )( window.jQuery || window.Zepto );
