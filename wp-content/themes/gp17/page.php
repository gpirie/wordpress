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

	while ( have_posts() ) : the_post(); 

		get_template_part( 'template-parts/content', 'page' ); 

	endwhile;

	echo '</main>';

	get_sidebar();
	
	get_footer(); 
?>
