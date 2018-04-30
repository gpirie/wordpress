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
		<?php /* translators: %s: search term */ ?>
		<h1 class="page-title"><?php printf( esc_html( 'Search Results for: %s', 'starter-theme' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
	</header>

	<?php
	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', 'starter-theme' );

	endwhile;

	// Previous/next page navigation.
	the_posts_pagination( array(
		'prev_text'          => __( 'Previous page', 'starter-theme' ),
		'next_text'          => __( 'Next page', 'starter-theme' ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'starter-theme' ) . ' </span>',
	) );

else :
	get_template_part( 'template-parts/content', 'none' );
endif;

echo '</main>';

get_footer();
