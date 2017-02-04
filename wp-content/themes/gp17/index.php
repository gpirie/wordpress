<?php
	/**
	 * The main template file. 
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package GP Web Design Theme
	 */

	get_header(); 

	echo '<main role="main" itemprop="mainContentOfPage">';

	if ( have_posts() ) : 

		while ( have_posts() ) : the_post(); 

			include( get_stylesheet_directory() . '/template-parts/content-o-media.php' );
			
		endwhile;

	else : 

		get_template_part( 'template-parts/content', 'none' );

	endif;

	echo '</main>';

	get_footer(); 

?>
