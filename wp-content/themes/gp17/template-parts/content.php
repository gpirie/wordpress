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

	<header class="o-post__header u-overflow u-relative">

		<?php

			the_title( '<h1 itemprop="title" class="o-post__title u-clear">', '</h1>' );			

			gpwd_post_thumbnail();

		?>

	</header><!-- .entry-header -->

	<div class="o-post__content u-overflow" itemprop="text articleBody">

		<?php

			the_excerpt();
		?>

	</div>	

	<footer class="o-post__footer u-clear u-hidden@print">
		
		<?php
			gpwd_get_the_categories();

			gpwd_get_the_tags();
		?>
		
	</footer>

</article>