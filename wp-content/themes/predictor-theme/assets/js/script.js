( function ( $ ) {

	$(document).ready(function() {

		//Nav Toggle
		//$('.c-toggle').next().hide();

		// $('.c-toggle').on('click', function() {
		// 	$(this).next().slideToggle();
		// });

		//Off Canvas Nav
		$('.c-toggle').on('click', function() {
			slide_off_canvas_menu();
		});

		function slide_off_canvas_menu() {
			if ($('.site-wrap').hasClass('has-visible-menu')) {
			  // Do things on Nav Close
			  $('.site-wrap').removeClass('has-visible-menu');
			} else {
			  // Do things on Nav Open
			  $('.site-wrap').addClass('has-visible-menu');
			}
		}

		//Tabs
		$('.o-tabs__link').on( 'click', function (e) {

			e.preventDefault();

			var content_show = $( this ).attr('href');

			$( '.is-visible' ).removeClass( 'is-visible' );
			$( '.o-tabs__navitem--visible' ).removeClass( 'o-tabs__navitem--visible' );


			$(this).parent().addClass( 'o-tabs__navitem--visible' );
			$(content_show).addClass( 'is-visible' );
		} );
	});

} )( window.jQuery || window.Zepto );
