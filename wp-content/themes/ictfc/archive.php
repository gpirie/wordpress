<?php
	/**
	 * The template for displaying archive pages
	 *
	 * Used to display archive-type pages if nothing more specific matches a query.
	 * For example, puts together date-based pages if no date.php file exists.
	 *
	 * If you'd like to further customize these archive views, you may create a
	 * new template file for each one. For example, tag.php (Tag archives),
	 * category.php (Category archives), author.php (Author archives), etc.
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package WordPress
	 * @subpackage ICTFC Theme
	 */

	get_header(); 

	echo '<main itemprop="mainContentOfPage">';

	if ( have_posts() ) : ?>

		<header>
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

		endwhile;

		the_posts_pagination( array(
			'prev_text'          => __( 'Previous page', 'ictfc-theme' ),
			'next_text'          => __( 'Next page', 'ictfc-theme' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'ictfc-theme' ) . ' </span>',
		) );

	else :
		get_template_part( 'template-parts/content', 'none' );

	endif;

	echo '</main>';

	get_sidebar();

	get_footer();