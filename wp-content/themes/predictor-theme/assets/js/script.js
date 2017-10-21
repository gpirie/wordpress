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
	});

} )( window.jQuery || window.Zepto );



    