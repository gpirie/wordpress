<?php
	defined( 'ABSPATH' ) or die( 'Nice try' );

	function fp_custom_login_form() {
		?>
			<div id="my-custom-login">
	<h2><?php _e( 'Login Here', 'buddypress' ) ?></h2>
	<?php wp_login_form(); ?>
	<a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="Lost Password">Lost Your Password?</a>
	</div>
	<?php
	}
