<?php
/**
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ICTFC Theme
 */

?>

<article <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

	<header class="o-post__header u-overflow u-relative">

		<?php

			the_title( '<h1 itemprop="title" class="o-post__title u-clear">', '</h1>' );			

			ict_post_thumbnail();

		?>

	</header><!-- .entry-header -->

	<div class="o-post__content u-overflow" itemprop="text articleBody">

		<?php

			the_content();
		?>

	</div>	

	<footer class="o-post__footer u-clear u-hidden@print">
		
		<?php
			ict_get_the_categories();

			ict_get_the_tags();
		?>
		
	</footer>

</article>
