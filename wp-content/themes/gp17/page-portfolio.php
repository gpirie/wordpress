<?php
	/**
	 * The main template file. 
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * Template Name: Portfolio
	 * 
	 * @package Theme Name
	 */

	get_header(); 

	echo '<main itemprop="mainContentOfPage">';

	while ( have_posts() ) : the_post(); 

		get_template_part( 'template-parts/content', 'portfolio' ); 

	endwhile;

	echo '</main>';

	get_sidebar();
	
	get_footer();
