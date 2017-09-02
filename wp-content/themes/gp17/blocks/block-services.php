<section class="o-block o-block--services">
	<?php

		if( have_rows( 'my_service' ) ) :
			?>
				<ul class="c-services">
			<?php

				while ( have_rows('my_service') ) : the_row();
					?>
						<li class="c-services__service">
							<?php
								if( false === empty( get_sub_field( 'title' ) ) ) {
									echo '<h1>'. get_sub_field( 'title' ) .'</h1>';
								}

								if( false === empty( get_sub_field( 'text' ) ) ) {
									echo '<h1>'. get_sub_field( 'text' ) .'</h1>';
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
