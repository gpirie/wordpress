<?php
/**
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Name
 */

?>

<article <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

	<header class="o-post__header u-overflow u-relative">

<<<<<<< HEAD
<<<<<<< HEAD:wp-content/themes/gp17/template-parts/content-single.php
		<?php the_title( '<h1 itemprop="title" class="o-post__title u-clear">', '</h1>' ); ?>
=======
		<?php

			the_title( '<h1 itemprop="title" class="o-post__title u-clear">', '</h1>' );			
=======
		<?php the_title( '<h1 itemprop="title" class="o-post__title u-clear">', '</h1>' ); ?>
>>>>>>> master

<<<<<<< HEAD:wp-content/themes/starter-theme/template-parts/content-single.php
			starter_post_thumbnail();

		?>
<<<<<<< HEAD
>>>>>>> 8224c2803ae2e271a935eee33153c050f10105e2:wp-content/themes/starter-theme/template-parts/content-single.php
=======
=======
		<p class="o-post__date u-inline">Posted on: <?php the_date();?> in</p> <?php gpwd_get_the_categories();?>
>>>>>>> faae6b754d128750c5ba0205495d04013fcb7b59:wp-content/themes/gp17/template-parts/content-single.php
>>>>>>> master

	</header><!-- .entry-header -->

	<div class="o-post__content u-overflow" itemprop="text articleBody">

		<?php the_content();?>

<<<<<<< HEAD
	</div>	
=======
	</div>
>>>>>>> master

	<footer class="o-post__footer u-clear u-hidden@print">

		<?php
			starter_get_the_categories();

			starter_get_the_tags();
		?>

	</footer>

</article>
