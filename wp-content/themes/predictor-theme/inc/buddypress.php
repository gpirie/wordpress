<?php
	defined( 'ABSPATH' ) or die( 'Nice try' );

	function fp_custom_login_form() {
		?>
			<?php wp_login_form(); ?>
			<a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="Lost Password">Lost Your Password?</a>
		<?php
	}
