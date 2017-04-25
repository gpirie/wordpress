<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Name
 */

?>	
	<footer itemscope="itemscope" itemtype="http://schema.org/WPFooter">
		
		<?php

			if ( get_theme_mod( 'copyright' ) ) 
			{				
				echo '<small>&copy; '. date('Y') . ' ' . get_theme_mod( 'copyright' ) .'</small>';
			}

		?>

	</footer>		

	<?php wp_footer();?>
	
	</body>
	
</html>