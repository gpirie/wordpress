<section class="o-block o-block--text" <?php echo ( get_sub_field( 'background_colour' ) ? 'style="background-color: '. get_sub_field( 'background_colour' ) .';"' : '' ) ?>>
	<?php

		if( false === empty( the_sub_field( 'text' ) ) ) {
			the_sub_field( 'text' );
		}

	?>
</section>
