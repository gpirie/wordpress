<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Name
 */

?>	
			<footer itemscope="itemscope" itemtype="http://schema.org/WPFooter">
				
				<?php

					gpwd_navigation( 'footer_menu' );

					{				
						echo '<small>&copy; '. date('Y') . ' ' . ( get_theme_mod( 'copyright' ) ? get_theme_mod( 'copyright' ) : get_bloginfo() ) .'</small>';
					}

				?>

			</footer>		

			<?php wp_footer();?>

		</div> <!--End site-wrap-->
	
	</body>
	
</html>