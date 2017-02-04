<?php
	function gpwd_get_latest_posts() {
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 2
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) : 

			echo '<ul class="o-latest">';

			while ( $query->have_posts() ) : $query->the_post();

			echo '<li>';
			the_title( '<h1 itemprop="title" class="o-post__title u-clear">', '</h1>' );
			echo '</li>';

			endwhile;

			echo '</ul>';

		endif;
	}