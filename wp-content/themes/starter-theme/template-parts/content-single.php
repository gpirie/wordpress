<?php
/**
 * Content for single template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Name
 */

?>

<article <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

	<header class="o-post__header u-overflow u-relative">

		<?php

			the_title( '<h1 itemprop="title" class="o-post__title u-clear">', '</h1>' );

			starter_post_meta();

			starter_socialize_sharing_bar();

			starter_post_thumbnail();

		?>

	</header>

	<div class="o-post__content u-overflow" itemprop="text articleBody">

		<?php the_content(); ?>

	</div>

	<footer class="o-post__footer u-clear u-hidden@print">

		<?php
			starter_get_the_categories();

			starter_get_the_tags();
		?>

	</footer>

</article>
