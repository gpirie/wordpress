<?php
	/**
	 * The main template file.
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package Predictor Theme
	 *
	 * Template Name: Home
	 *
	 */

	get_header();

	echo '<main class="o-maincontent u-clear" itemprop="mainContentOfPage">';

	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', 'home' );

	endwhile;

	echo '</main>';

	get_footer();
