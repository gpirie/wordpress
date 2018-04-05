<?php
/**
 * The main template file.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Name
 */

get_header();

echo '<main itemprop="mainContentOfPage">';

if ( have_posts() ) :

	while ( have_posts() ) : the_post();

		get_template_part( 'content', get_post_format() );

	endwhile;

	the_posts_pagination( array(
		'screen_reader_text' => ' ',
		)
	);

else :

	get_template_part( 'template-parts/content', 'none' );

	echo '</main>';

	get_sidebar();

endif;

wp_reset_postdata();

get_footer();
