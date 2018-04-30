<?php
/**
 * Template for WordPress search form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Name
 */

?>
<form role="search" method="get" class="o-form o-form--searchform js-searchtoggle" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="u-visuallyhidden"><?php esc_html_e( 'Search for:', 'starter-theme' ) ?></label>
	<input type="search" class="o-form__field o-form--searchform__field" placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder', 'starter-theme' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'starter-theme' ) ?>" />

	<input type="submit" class="o-form__field o-form--searchform__button button" value="<?php echo esc_attr_x( 'Search', 'submit button', 'starter-theme' ) ?>" />
</form>
