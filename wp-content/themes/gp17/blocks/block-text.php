<?php
	$bg_image = get_sub_field( 'background_image' );

?>

<section class="o-block o-block--text <?php if( $bg_image ) : echo 'o-block--background-image" style="background-image: url('. $bg_image['url'] .')"'; endif; ?>">

	<?php

		if ( false === empty( get_sub_field('text') ) ) :

			echo get_sub_field('text');

		endif;
	?>

</section>