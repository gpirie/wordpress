<?php
/**
 * Template for single content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Name
 */

get_header();

echo '<main itemprop="mainContentOfPage">';

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/content', 'single' );

endwhile;

wp_link_pages();

get_sidebar( 'sidebar' );

echo '</main>';

get_footer();
