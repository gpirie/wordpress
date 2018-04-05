<?php
/**
 * Template for the sidebar.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Name
 */

if ( is_active_sidebar( 'site-sidebar' ) ) {
	?>
		<aside class="sidebar u-hidden@print">

		<?php dynamic_sidebar( 'site-sidebar' ); ?>

		</aside>
	<?php
}
