<?php
	/**
	 * The main template file. 
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package GP Web Design Theme
	 *
	 * Template Name: Home
	 *
	 */

	get_header(); 

	echo '<main role="main" itemprop="mainContentOfPage">';

	while ( have_posts() ) : the_post(); 

		$intro = get_field( 'introduction' );

		if ( $intro ) :

			echo '<q class="introduction u-block u-centre-text">';
			echo get_field( 'introduction' );
			echo '</q>';

		endif;

		$args = array(
			'post_type' => 'portfolio'
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) : 

			echo '<ul class="o-portfolio">';

			while ( $query->have_posts() ) : $query->the_post();

				echo '<li class="o-portfolio__item u-relative u-overflow">';

				if ( has_post_thumbnail() ) :

					echo get_the_post_thumbnail( $post_id, 'medium', array( 'class' => 'o-portfolio__image' ) );

				else :

					echo '<img src="http://placehold.it/500x499&text=Portfolio+Image" />';

				endif;

				echo '<div class="o-portfolio__detail u-absolute u-centre-text">';

				the_title( '<h1 itemprop="title" class="o-post__title u-clear">', '</h1>' );

				echo '<a class="button u-inline-block" href="'. get_the_permalink() .'" title="'. get_the_title() .'">View</a>';

				echo '</div>';

				echo '</li>';

			endwhile;

			echo '</ul>';

		endif;

		gpwd_get_latest_posts();

		gpwd_get_latest_snippets();

	endwhile;

	echo '</main>';

	get_sidebar();
	
	get_footer(); 
?>
