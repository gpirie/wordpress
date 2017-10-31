<?php
/**
 * Plugin Name: Football Predictor Blocks
 * Plugin URI: https://www.graemepirie.com
 * Description: Custom Blocks added to gutenberg for the Predictor website.
 * Version: 1.0.0
 * Author: Graeme Pirie
 * Author URI:http://graemepirie.com/
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: predictor-blocks
*/

defined( 'ABSPATH' ) or die();

function predictor_enqueue_block_editor_assets() {
	wp_enqueue_script( 'predictor-block', plugins_url( 'block.js', __FILE__ ), array( 'wp-blocks', 'wp-element' ) );
}
add_action( 'enqueue_block_editor_assets', 'predictor_enqueue_block_editor_assets' );

function predictor_block_init() {
	// Register the postmeta key that we'll store our data in
	register_meta( 'post', 'stars', array(
		'show_in_rest' => true,
		'single'       => true,
		'type'         => 'integer',
	) );
}
add_action( 'init', 'predictor_block_init' );
