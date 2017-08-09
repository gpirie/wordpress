(function ($) {

    "use strict";
    
    //Document Ready
    $(document).ready(function ()
    {
    	$('.o-navtoggle').next().hide();
		$('.o-navtoggle').on('click', function() {
			$('.o-navtoggle').next().slideToggle('slow');
		});		
    });

}(jQuery));