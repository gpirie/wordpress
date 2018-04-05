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

echo '</main>';

get_sidebar( 'site-sidebar' );

get_footer();
