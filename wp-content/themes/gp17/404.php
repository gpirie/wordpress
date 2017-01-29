<?php
	/**
	 * The template for displaying 404 pages (not found)
	 *
	 * @package WordPress
	 * @subpackage Wyvex
	 */

	get_header(); 

	echo '<main role="main" itemprop="mainContentOfPage">';

	get_template_part( 'template-parts/content', 'none' ); 

	echo '</main>';

	get_sidebar();
	
	get_footer(); 
