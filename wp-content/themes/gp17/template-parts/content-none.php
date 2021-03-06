<?php
/**
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Name
 */

?>

<article <?php post_class(); ?> itemscope itemtype="http://schema.org/WebPage">

	<header class="o-page__header u-overflow u-relative">

		<?php the_title( '<h1 itemprop="title" class="o-post__title">', '</h1>' ); ?>

		<p class="o-post__date u-inline">Posted on: <?php the_date();?> in</p> <?php gpwd_get_the_categories();?>

	</header>

	<div class="o-page__content" itemprop="text articleBody">

		<?php the_content(); ?>

	</div>

	<footer class="o-page__footer u-clear u-hidden@print">

	</footer>

</article>
