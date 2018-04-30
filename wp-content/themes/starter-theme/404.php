<?php
	/**
	 * The template for displaying 404 pages (not found)
	 *
	 * @package WordPress
	 * @subpackage Theme Name
	 */

	get_header();

	echo '<main itemprop="mainContentOfPage">';

	get_template_part( 'template-parts/content', 'none' );

	echo '</main>';

	get_sidebar();

	get_footer();
