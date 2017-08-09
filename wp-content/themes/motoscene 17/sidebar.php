<?php
	if ( is_active_sidebar( 'site-sidebar' ) && is_dynamic_sidebar() ) :

		?>
			<aside class="sidebar u-hidden@print" role="complementary">
			
				<?php dynamic_sidebar('site-sidebar'); ?>
			
			</aside>
		<?php

	endif;