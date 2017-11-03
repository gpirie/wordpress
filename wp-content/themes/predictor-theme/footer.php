<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Predictor Theme
 */

?>
			<footer class="site-footer u-overflow u-clear" itemscope="itemscope" itemtype="http://schema.org/WPFooter">

				<?php fp_site_logo( 'footer' );?>

				<?php fp_navigation( 'footer_menu' );?>

			</footer>

			<small class="copyright u-block u-clear">&copy; <?php echo date('Y') . ' ' . ( get_theme_mod( 'copyright' ) ? get_theme_mod( 'copyright' ) : get_bloginfo( 'name' ) );?></small>

			<?php wp_footer();?>

		</div> <!--End site-wrap-->

	</body>

</html>
