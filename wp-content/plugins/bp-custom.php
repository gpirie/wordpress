<?php
	define('BP_LOGIN_SLUG', 'login');

	function restrict_access() {
		global $bp, $bp_unfiltered_uri;

		if (!is_user_logged_in() && (BP_REGISTER_SLUG != $bp->current_component) && (BP_LOGIN_SLUG != $bp->current_component)) {
			bp_core_redirect( $bp->root_domain . '/' . BP_LOGIN_SLUG );
		}
	}
	add_action( 'wp', 'restrict_access', 3 );

	function example_page_setup_root_component() {
		bp_core_add_root_component( BP_LOGIN_SLUG );
	}
	add_action( 'plugins_loaded', 'example_page_setup_root_component', 2 );

	function bp_show_login_page() {
		global $bp, $current_blog;

		if ( $bp->current_component == BP_LOGIN_SLUG && $bp->current_action == '' ) {
			bp_core_load_template( 'login', true );
		}
	}
	add_action( 'wp', 'bp_show_login_page', 2 );
