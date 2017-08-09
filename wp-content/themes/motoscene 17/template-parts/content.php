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
		
		<?php

			the_title( '<h1 itemprop="title" class="o-post__title u-clear">', '</h1>' );			

			if ( has_post_thumbnail() ) :

				echo '<figure class="o-post__media">';

				the_post_thumbnail('large', array( 'class' => 'o-post__image u-full-width', 'itemprop' => 'image' ) );
				
				if ( $caption ) :
					echo '<figcaption class="o-post__caption u-relative">'. $caption .'</figcaption>';
				endif;

				echo '</figure>';

			endif;

		?>

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

	</footer>

</article>