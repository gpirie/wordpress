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
		?>

		<header class="page-header">
			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'wyvex' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
		</header><!-- .page-header -->

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'search' );

		// End the loop.
		endwhile;

		// Previous/next page navigation.
		the_posts_pagination( array(
			'prev_text'          => __( 'Previous page', 'wyvex' ),
			'next_text'          => __( 'Next page', 'wyvex' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'wyvex' ) . ' </span>',
		) );

	// If no content, include the "No posts found" template.
	else :
		get_template_part( 'template-parts/content', 'none' );

	endif;

	echo '</main>';

	get_footer();