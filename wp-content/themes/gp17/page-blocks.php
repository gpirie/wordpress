<?php
	/**
	 * The main template file. 
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package GP Web Design Theme
	 *
	 * Template Name: Blocks
	 *
	 */

	get_header(); 

	echo '<main role="main" itemprop="mainContentOfPage">';

	while ( have_posts() ) : the_post(); 

		if( have_rows('blocks') ) :

		    while ( have_rows('blocks') ) : the_row();
			
				get_template_part( 'blocks/block', get_row_layout() );
		    
		    endwhile;
		
		else :
		    
		    if ( current_user_can('edit_posts') ) :
		    
		    	echo '<div class="wrapper page-wrapper centre">';
		    	echo '<p class="notice warning">Add some blocks to start creating this page.</p>';
		    	echo '</div>';
		    
		    endif;
		
		endif;		

	endwhile;

	echo '</main>';

	get_sidebar();
	
	get_footer(); 

