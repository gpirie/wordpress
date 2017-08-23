<section class="o-block o-block--portfolio">

	<h1><?php echo get_sub_field( 'title' );?></h1>

	<?php

		if( have_rows('my_service') ) :

			?>
				<ul class="c-services">
			<?php

			while ( have_rows('my_service') ) : the_row();

				if( false === empty( get_sub_field( 'title' ) ) ) :

					echo '<h1 class="c-services__title">'. get_sub_field( 'title' ) .'</h1>';

				endif;

				if( false === empty( get_sub_field( 'text' ) ) ) :

					echo '<p class="c-services__text">'. get_sub_field( 'text' ) .'</p>';

				endif;

			endwhile;

			?>
				</ul>
			<?php

		endif;

	?>

</section>