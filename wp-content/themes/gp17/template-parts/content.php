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

		<h1 itemprop="title" class="o-post__title u-clear">
			<a class="o-post__titlelink" title="<?php the_title();?>" href="<?php the_permalink();?>">
				<?php the_title();?>
			</a>
		</h1>

	</header><!-- .entry-header -->

	<div class="o-post__content u-overflow" itemprop="text articleBody">

		<?php the_excerpt();?>

	</div>	

	<footer class="o-post__footer u-clear u-hidden@print">
		
		<a class="o-button o-button__post" title="<?php the_title();?>" href="<?php the_permalink();?>">
			Read More
		</a>

	</footer>

</article>