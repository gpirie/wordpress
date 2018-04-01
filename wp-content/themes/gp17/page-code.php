<?php
	/**
	 * The main template file.
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * Template Name: Code
	 *
	 * @package Theme Name
	 */

	get_header();

	echo '<main itemprop="mainContentOfPage">';

	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', 'code' ); 

	endwhile;

	echo '</main>';

	get_sidebar();

	get_footer();
