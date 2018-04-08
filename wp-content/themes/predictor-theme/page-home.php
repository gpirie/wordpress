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

	echo '<main class="o-maincontent o-maincontent--'. get_post_field( 'post_name', get_post() ) .' u-clear" itemprop="mainContentOfPage">';

	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', 'home' );

	endwhile;

	echo '</main>';

	get_footer();
