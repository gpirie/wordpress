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

			echo '<q class="introduction u-block">';
			echo get_field( 'introduction' );
			echo '</q>';

		endif;

	endwhile;

	echo '</main>';

	get_sidebar();
	
	get_footer(); 
?>
