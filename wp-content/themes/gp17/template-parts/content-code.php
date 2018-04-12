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

	</header>

	<div class="o-page__content" itemprop="text articleBody">

		<?php
			the_content();

			gpwd_get_snippets();
		?>

	</div>
	
</article>
