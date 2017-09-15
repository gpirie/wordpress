<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Name
 */

?>	
			<footer class="site-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
				
				<small class="copyright">&copy; <?php echo date('Y');?> <?php echo ( get_theme_mod( 'copyright' ) ? get_theme_mod( 'copyright' ) : get_bloginfo() ) ?> </small>
					
			</footer>		

			<?php wp_footer();?>

		</div> <!--End site-wrap-->
	
	</body>
	
</html>