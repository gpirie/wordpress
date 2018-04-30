<?php
/**
 * Template for the sidebar.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Name
 */

if ( is_active_sidebar( 'sidebar' ) ) {
	?>
		<aside class="o-sidebar u-hidden@print">

		<?php dynamic_sidebar( 'sidebar' ); ?>

		</aside>
	<?php
}
