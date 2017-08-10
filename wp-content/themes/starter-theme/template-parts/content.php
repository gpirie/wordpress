<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DCT Events Theme
 */

?>

<article <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
	
	<header>
		
		<?php the_title( sprintf( '<h1 itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>

			<div class="entry-meta">
				<?php dct_events_theme_posted_on(); ?>
			</div><!-- .entry-meta -->

		<?php endif; ?>

	</header>

	<div itemprop="text">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'dct-events-theme' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dct-events-theme' ),
				'after'  => '</div>',
			) );
		?>
	</div>

	<footer>

		<?php dct_events_theme_entry_footer(); ?>

	</footer>

</article>