<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GP Web Design Theme
 */

?>	
		<footer itemscope="itemscope" itemtype="http://schema.org/WPFooter">

			<?php

				if ( has_nav_menu( 'footer' ) ) :

					wp_nav_menu( array( 'container'=> 'nav', 'container_class' => 'c-footermenu overflow', 'theme_location' => 'footer', 'menu_class' => '' ) );
				
				endif;

			?>

			<small>&copy; <?php echo get_bloginfo();?> 2008 &ndash; <?php echo date('Y');?></small>

		</footer>

		<?php wp_footer();?>

	</body>

</html>