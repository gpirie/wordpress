<?php
	/**
	 * The main template file. 
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package Theme Name
	 */

	get_header(); 

	echo '<main itemprop="mainContentOfPage">';

	if ( have_posts() ) : 

		while ( have_posts() ) : the_post(); 

			get_template_part( 'template-parts/content', get_post_format() );

		endwhile;
		
	else : 

		get_template_part( 'template-parts/content', 'none' );

	endif;

	echo '</main>';

	get_footer();
