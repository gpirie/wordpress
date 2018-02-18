<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ICTFC Theme
 */

?>	
			<footer itemscope="itemscope" itemtype="http://schema.org/WPFooter">
				
				<small class="copyright u-block u-clear">&copy; <?php echo date('Y') . ' ' . ( get_theme_mod( 'copyright' ) ? get_theme_mod( 'copyright' ) : get_bloginfo( 'name' ) );?></small>
				
			</footer>		

			<?php wp_footer();?>

		</div> <!--End site-wrap-->
	
	</body>
	
</html>