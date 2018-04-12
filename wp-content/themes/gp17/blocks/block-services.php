
<section class="o-block o-block--services">
	<?php

		if( have_rows( 'my_service' ) ) :
			?>
				<ul class="c-services u-overflow">
			<?php
			
				while ( have_rows('my_service') ) : the_row();
					?>
						<li class="c-services__service u-centre-text">
							<?php
								if( false === empty( get_sub_field( 'title' ) ) ) {
									echo '<h2>'. get_sub_field( 'title' ) .'</h2>';
								}

								if( false === empty( get_sub_field( 'text' ) ) ) {
									the_sub_field( 'text' );
								}
							?>
						</li>
					<?php
				
				endwhile;

			?>
				</ul>
			<?php

		endif;

	?>

</section>