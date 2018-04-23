<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Name
 */

?>
			<footer class="site-footer u-overflow" itemscope="itemscope" itemtype="http://schema.org/WPFooter">

				<?php
					gpwd_get_the_custom_logo( 'site-footer' );

					gpwd_navigation( 'footer_menu' );

					gpwd_contact_details();

				?>

			</footer>

			<small class="copyright u-block u-clear">&copy; <?php echo date('Y') . ' ' . ( get_theme_mod( 'copyright' ) ? get_theme_mod( 'copyright' ) : get_bloginfo() );?></small>

			<?php wp_footer();?>

		</div> <!--End site-wrap-->

	</body>

</html>
