<section class="o-block o-block--portfolio">

	<h1><?php echo get_sub_field( 'title' );?></h1>

	<?php

		if( have_rows('projects') ) :

			while ( have_rows('projects') ) : the_row();

				$post_objects = get_sub_field( 'portfolio_item' );

				$count = count( $post_objects );

				if( $post_objects ) : ?>

					<ul class="o-portfoliolist">
					    <?php 
					    	foreach( $post_objects as $post) :
					        	setup_postdata($post);
					        	?>
							        <li class="o-portfoliolist__item u-relative">
							        	<?php starter_post_thumbnail(); ?>
							        	<a class="o-portfoliolist__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							        </li>
					    		<?php
					    	endforeach; 
					    ?>
				    </ul>

				    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
				
				<?php endif;

			endwhile;

		endif;

	?>

</section>