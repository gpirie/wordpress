<?php
	/**
	 * The main template file. 
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * Template Name: Blocks
	 *
	 * @package Theme Name
	 */

	get_header(); 

	echo '<main itemprop="mainContentOfPage">';

	while ( have_posts() ) : the_post(); 

		if( have_rows('blocks') ) :

		    while ( have_rows('blocks') ) : the_row();
		        get_template_part( 'blocks/block', get_row_layout() );
		    endwhile;
		
		else :
		    if ( current_user_can('edit_posts') ) :
		    	echo '<p class="c-notice c-notice--info">Add some blocks to start creating this page.</p>';		    	
		    endif;
		
		endif;

	endwhile;

	echo '</main>';

	get_sidebar();
	
	get_footer();
