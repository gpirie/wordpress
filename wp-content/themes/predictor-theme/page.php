<?php
	/**
	 * The main template file.
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package Predictor Theme
	 */

	get_header();

	echo '<main class="o-maincontent u-clear" itemprop="mainContentOfPage">';

	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', 'page' );

	endwhile;

	echo '</main>';

	get_sidebar( 'site-sidebar' );

	get_footer();
