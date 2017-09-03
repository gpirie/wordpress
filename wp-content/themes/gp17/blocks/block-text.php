<style>
	.o-block--text {
		border-left: 600rem solid <?php the_sub_field( 'background_colour' );?>;
		border-right: 600rem solid <?php the_sub_field( 'background_colour' );?>;
	}
</style>

<section class="o-block o-block--text u-overflow u-centre-text" <?php echo ( get_sub_field( 'background_colour' ) ? 'style="background-color: '. get_sub_field( 'background_colour' ) .';"' : '' ) ?>>
	<?php

		if( false === empty( the_sub_field( 'text' ) ) ) {
			the_sub_field( 'text' );
		}

	?>
</section>
