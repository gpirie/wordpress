<?php
	/**
	 * The main template file. 
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package MotoScene Theme
	 */

	get_header(); 

	echo '<main class="site-main u-clear u-overflow '. wyvex_page_class() .'" role="main" itemprop="mainContentOfPage">';

	if ( have_posts() ) : 

		$postcount = 0;

		while ( have_posts() ) : the_post(); 

			include( get_stylesheet_directory() . '/template-parts/content-o-media.php' );

			$postcount++;

		endwhile;

		wp_reset_postdata();

	else : 

		get_template_part( 'template-parts/content', 'none' );

	endif;

	echo '</main>';

	get_footer(); 

?>
