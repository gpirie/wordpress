<?php
/**
 * Plugin Name: Football Predictor
 * Plugin URI: https://www.graemepirie.com
 * Description: Football Predictor game which assigns points based on correct scoring system.
 * Version: 1.0.0
 * Author: Graeme Pirie
 * Author URI:http://graemepirie.com/
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: predictor
*/

defined( 'ABSPATH' ) or die();

define( 'PREDICTOR_VERSION', '1.0.0' );
define( 'PREDICTOR_DB_VERSION', '20171010' );
define( 'PREDICTOR_DIR', dirname( __FILE__ ) . '/' );

/** Processing includes. */
require_once( PREDICTOR_DIR . 'globals.php' );
require_once( PREDICTOR_DIR . 'inc/build.php' );
require_once( PREDICTOR_DIR . 'functions.php' );
// require_once( PREDICTOR_DIR . 'inc/api.php' );
// require_once( PREDICTOR_DIR . 'inc/cron.php' );
require_once( PREDICTOR_DIR . 'inc/admin.php' );

// require_once( PREDICTOR_DIR . 'ui/home.php' );

function predictor_activate() {
	predictor_install();
	predictor_maybe_upgrade();
}
register_activation_hook( __FILE__, 'predictor_activate' );

function predictor_deactivate() {
	flush_rewrite_rules( false );
}
register_deactivation_hook( __FILE__, 'predictor_deactivate' );

function predictor_maybe_upgrade() {
	$current_db_version = get_option( 'predictor_importer_db_version', null );
	$current_version = get_option( 'predictor_importer_version', null );

	update_option( 'predictor_importer_version', PREDICTOR_VERSION );

	/** Exit if the database version number is identical. */
	if ( $current_db_version === PREDICTOR_DB_VERSION ) {
		return;
	}
}
add_action( 'plugins_loaded', 'predictor_maybe_upgrade' );
