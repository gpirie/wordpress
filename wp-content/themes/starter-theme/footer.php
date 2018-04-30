<?php
/**
 * Theme footer file.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Name
 */

?>
		<footer class="site-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">

			<small class="copyright u-block u-clear">&copy; <?php echo( esc_html( date( 'Y' ), 'starter-theme' ) . ' ' . ( get_theme_mod( 'copyright' ) ? esc_html( get_theme_mod( 'copyright' ), 'starter-theme' ) : esc_html( get_bloginfo( 'name' ), 'starter-theme' ) ) );?></small>

		</footer>

		<?php wp_footer();?>

	</body>

</html>
