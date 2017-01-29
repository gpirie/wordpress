<?php
/**
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wyvex Theme
 */

?>

<article <?php post_class('o-post'); ?> itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

	<header class="o-post__header u-overflow u-relative">

		<?php

			the_title( '<h1 itemprop="title" class="o-post__title u-clear">', '</h1>' );

			if ( has_post_thumbnail() ) :

				echo '<figure class="o-post__media">';

				the_post_thumbnail('large', array( 'class' => 'o-post__image u-full-width', 'itemprop' => 'image' ) );

				if ( wpc_get_attachment_caption() ) :
		            echo '<figcaption>' . wpc_get_attachment_caption() . '</figcaption>';
		        endif;

				echo '</figure>';

			endif;

		?>

	</header><!-- .entry-header -->


	<div itemprop="text articleBody">

		<?php the_content(); ?>

	</div>

	<footer class="o-post__footer u-clear">		
		

	</footer>

</article>
