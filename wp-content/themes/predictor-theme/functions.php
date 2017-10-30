<?php

/**
 * Starter Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Predictor Theme
 */

defined( 'ABSPATH' ) or die( 'Nice try' );

define( 'FP_VERSION', '1.0.0-beta1' );
define( 'FP_DIRECTORY_URI', get_template_directory_uri() );
define( 'FP_THEME_INC', get_template_directory() );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

function fp_theme_setup()
{
	//Navigation Menus
	register_nav_menus( array(
		'main_menu' => esc_html__( 'Main Menu', 'fp-theme' ),
		'footer_menu' => esc_html__( 'Footer Menu', 'fp-theme' ),
		'header_menu' => esc_html__( 'Header Menu', 'fp-theme' ),
	) );

	//Theme Support
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'gallery', 'video' ) );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'colors' );
	add_theme_support( 'html5', array('search-form', 'gallery', 'caption', ) );
	add_theme_support( 'customize-selective-refresh-widgets' );

	//Gutenberg
	add_theme_support( 'gutenberg', array(
		'wide-images' => true,
	) );

	//Remove unwanted WP elements
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
    remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'feed_links_extra', 3);

	//Woocommerce
	if( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		//remove woocommerce default css
		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

		add_action( 'woocommerce_after_single_product_summary', 'woocommerce_product_description_tab' );
		add_action( 'woocommerce_after_single_product_summary', 'woocommerce_product_additional_information_tab' );
		add_action( 'woocommerce_after_single_product_summary', 'comments_template' );

		//Product page order
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	}
}
add_action( 'after_setup_theme', 'fp_theme_setup' );

function fp_customizer_remove_css_section( $wp_customize ) {
	$wp_customize->remove_section( 'custom_css' );
}
add_action( 'customize_register', 'fp_customizer_remove_css_section', 15 );

function fp_sidebars() {
	register_sidebar( array(
		'name' => 'Site Sidebar',
		'id' => 'site-sidebar',
		'description'   => __( 'Add widgets to the sidebar throughout the site.', 'wyvex' ),
		'before_widget' => '<aside class="o-widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="o-widget__title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'fp_sidebars' );

function fp_gallery_atts( $output, $pairs, $atts ) {
	$output['size'] = 'medium';

	return $output;
}
add_filter( 'shortcode_atts_gallery', 'fp_gallery_atts', 10, 3 );

function fp_theme_scripts()
{
	/* CSS*/

	/* Generic */
	wp_enqueue_style( 'fp-theme-helper', FP_DIRECTORY_URI . '/assets/css/generic.helper.css' ,null, FP_VERSION, 'all' );
	wp_enqueue_style( 'fp-theme-reset', FP_DIRECTORY_URI . '/assets/css/generic.reset.css' ,null, FP_VERSION, 'all' );
	wp_enqueue_style( 'fp-theme-settings', FP_DIRECTORY_URI . '/assets/css/settings.global.css' ,null, FP_VERSION, 'screen' );

	/* Elements */
	wp_enqueue_style( 'fp-theme-headings', FP_DIRECTORY_URI . '/assets/css/elements.headings.css' ,null, FP_VERSION, 'screen' );
	wp_enqueue_style( 'fp-theme-type', FP_DIRECTORY_URI . '/assets/css/elements.type.css' ,null, FP_VERSION, 'screen' );
	wp_enqueue_style( 'fp-theme-forms', FP_DIRECTORY_URI . '/assets/css/elements.forms.css' ,null, FP_VERSION, 'screen' );

	/* Objects */
	wp_enqueue_style( 'fp-theme-pagination', FP_DIRECTORY_URI . '/assets/css/object.pagination.css' ,null, FP_VERSION, 'screen' );
	wp_enqueue_style( 'fp-theme-predictionform', FP_DIRECTORY_URI . '/assets/css/object.predictionsform.css' ,null, FP_VERSION, 'screen' );
	wp_enqueue_style( 'fp-theme-page', FP_DIRECTORY_URI . '/assets/css/object.page.css' ,null, FP_VERSION, 'screen' );

	/* Components */
	wp_enqueue_style( 'fp-theme-header', FP_DIRECTORY_URI . '/assets/css/components.header.css' ,null, FP_VERSION, 'screen' );
	wp_enqueue_style( 'fp-theme-sidebar', FP_DIRECTORY_URI . '/assets/css/components.sidebar.css' ,null, FP_VERSION, 'screen' );
	wp_enqueue_style( 'fp-theme-nav', FP_DIRECTORY_URI . '/assets/css/components.nav.css' ,null, FP_VERSION, 'screen' );
	wp_enqueue_style( 'fp-theme-post', FP_DIRECTORY_URI . '/assets/css/components.post.css' ,null, FP_VERSION, 'screen' );
	wp_enqueue_style( 'fp-theme-footer', FP_DIRECTORY_URI . '/assets/css/components.footer.css' ,null, FP_VERSION, 'screen' );
	wp_enqueue_style( 'fp-theme-register', FP_DIRECTORY_URI . '/assets/css/components.register.css' ,null, FP_VERSION, 'screen' );

	/* External */
	wp_enqueue_style( 'fp-googlefonts', '//fonts.googleapis.com/css?family=Roboto+Mono:400,700|Rubik:900' );

	/* WooCommerce */
	if( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
		wp_enqueue_style( 'fp-theme-product', FP_DIRECTORY_URI . '/assets/css/object.product.css' ,null, FP_VERSION, 'screen' );
		wp_enqueue_style( 'fp-theme-shop-loop', FP_DIRECTORY_URI . '/assets/css/object.shoploop.css' ,null, FP_VERSION, 'screen' );
		wp_enqueue_style( 'fp-theme-shop-gallery', FP_DIRECTORY_URI . '/assets/css/object.productgallery.css' ,null, FP_VERSION, 'screen' );
		wp_enqueue_style( 'fp-theme-shop-checkout', FP_DIRECTORY_URI . '/assets/css/components.checkout.css' ,null, FP_VERSION, 'screen' );
		wp_enqueue_style( 'fp-theme-shop-cart', FP_DIRECTORY_URI . '/assets/css/components.cart.css' ,null, FP_VERSION, 'screen' );
		wp_enqueue_style( 'fp-theme-shop-account', FP_DIRECTORY_URI . '/assets/css/components.account.css' ,null, FP_VERSION, 'screen' );
	}

	/* Trumps */
	wp_enqueue_style( 'fp-style', FP_DIRECTORY_URI . '/style.css' ,null, FP_VERSION, 'screen' );

	/* Remove BuddyPress Styles */
	wp_dequeue_style( 'bp-legacy-css' );

	/* JS */
	wp_enqueue_script( 'fp-script', FP_DIRECTORY_URI . '/assets/js/script.js', array(), FP_VERSION, true );

	wp_enqueue_script( 'html5shiv', FP_DIRECTORY_URI . '/assets/js/html5-shiv.js', array(), '3.7.2', false );
	add_filter( 'script_loader_tag', function( $tag, $handle )
	{
	    if ( $handle === 'html5shiv' ) :
	        $tag = "<!--[if lt IE 9]>$tag<![endif]-->";
	    endif;
	    return $tag;
	}, 10, 2 );

}
add_action( 'wp_enqueue_scripts', 'fp_theme_scripts' );

//Remove height and width attributes
add_filter( 'post_thumbnail_html', 'fp_remove_image_attributes', 10 );
add_filter( 'image_send_to_editor', 'fp_remove_image_attributes', 10 );
add_filter( 'get_custom_logo', 'fp_remove_image_attributes', 10 );
add_filter( 'img_caption_shortcode', 'fp_remove_image_attributes' , 10 );

function fp_remove_image_attributes( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

function fp_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	return $image[0];
}

require_once ( FP_THEME_INC . '/inc/customiser.php' );
require_once ( FP_THEME_INC . '/inc/template-tags.php' );
require_once ( FP_THEME_INC . '/inc/buddypress.php' );

if( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	require_once ( FP_THEME_INC . '/inc/woocommerce.php' );
}
