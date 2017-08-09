<?php
/**
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Name
 */

?>

<article <?php post_class('o-page'); ?> itemscope itemtype="http://schema.org/WebPage">

	<header>

		<?php

			the_title( '<h1 itemprop="title" class="o-post__title">', '</h1>' );			
			
			if ( has_post_thumbnail() ) :

				echo '<figure class="o-post__media">';

				the_post_thumbnail('large', array( 'class' => 'o-post__image u-full-width', 'itemprop' => 'image' ) );

				if ( wpc_get_attachment_caption() ) :
		            echo '<figcaption>' . wpc_get_attachment_caption() . '</figcaption>';
		        endif;

				echo '</figure>';

			endif;
		?>

	</header>

	<div class="o-page__content" itemprop="text articleBody">

		<?php the_content(); ?>

	</div>	

</article>
