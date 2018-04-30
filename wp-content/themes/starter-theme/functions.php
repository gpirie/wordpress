<?php
/**
 * Template for the site header.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Theme Name
 */

defined( 'ABSPATH' ) || die( 'Nice try' );

if ( ! isset( $content_width ) ) {
	$content_width = 900;
}

define( 'STARTER_VERSION', '1.0.0-beta' );
define( 'STARTER_DIRECTORY_URI', get_template_directory_uri() );
define( 'STARTER_THEME_INC', get_template_directory() );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Sets up the theme menus and configurables
 *
 * @access   public
 * @since    1.0.0
 */
function starter_theme_setup() {
	register_nav_menus( array(
		'main_menu' => esc_html__( 'Main Menu', 'starter-theme' ),
		'footer_menu' => esc_html__( 'Footer Menu', 'starter-theme' ),
	) );

	// Theme Support.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'gallery', 'video' ) );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'colors' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background' );

	// Remove unwanted WP elements.
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );

	// Woocommerce.
	if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// remove woocommerce default css.
		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

		add_action( 'woocommerce_after_single_product_summary', 'woocommerce_product_description_tab' );
		add_action( 'woocommerce_after_single_product_summary', 'woocommerce_product_additional_information_tab' );
		add_action( 'woocommerce_after_single_product_summary', 'comments_template' );

		// Extra Image sizes.
		add_image_size( 'order_thumbnail', 75, 75 );

		// Product page order.
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}
}
add_action( 'after_setup_theme', 'starter_theme_setup' );

/**
 * Removes the css section from the customizer. This stops users adding their own css to the theme.
 *
 * @access  public
 * @since   1.0.0
 * @param   array $wp_customize The html for the gallery shortcode.
 */
function starter_customizer_remove_css_section( $wp_customize ) {
	$wp_customize->remove_section( 'custom_css' );
}
add_action( 'customize_register', 'starter_customizer_remove_css_section', 15 );

/**
 * Sets up the theme sidebar
 *
 * @access   public
 * @since    1.0.0
 */
function starter_sidebars() {
	register_sidebar( array(
		'name' => 'Sidebar',
		'id' => 'sidebar',
		'description'   => __( 'Add widgets to the sidebar throughout the site.', 'starter-theme' ),
		'before_widget' => '<aside class="o-widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="o-widget__title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'starter_sidebars' );

/**
 * Sets the size of the images within the gallery.
 *
 * @access   public
 * @since    1.0.0
 * @param    array $output The html for the gallery shortcode.
 * @param    array $pairs The info sent from process-purchase.php.
 * @param    array $atts The info sent from process-purchase.php.
 * @return   array
 */
function starter_gallery_atts( $output, $pairs, $atts ) {
	$output['size'] = 'medium';

	return $output;
}
add_filter( 'shortcode_atts_gallery', 'starter_gallery_atts', 10, 3 );

/**
 * Enqueues style and script files.
 *
 * @access   public
 * @since    1.0.0
 */
function starter_theme_scripts() {
	/* CSS*/

	/* Generic */
	wp_enqueue_style( 'starter-theme-helper', STARTER_DIRECTORY_URI . '/assets/css/generic.helper.css' ,null, STARTER_VERSION, 'all' );
	wp_enqueue_style( 'starter-theme-reset', STARTER_DIRECTORY_URI . '/assets/css/generic.reset.css' ,null, STARTER_VERSION, 'all' );
	wp_enqueue_style( 'starter-theme-settings', STARTER_DIRECTORY_URI . '/assets/css/settings.global.css' ,null, STARTER_VERSION, 'screen' );

	/* Elements */
	wp_enqueue_style( 'starter-theme-headings', STARTER_DIRECTORY_URI . '/assets/css/elements.headings.css' ,null, STARTER_VERSION, 'screen' );
	wp_enqueue_style( 'starter-theme-type', STARTER_DIRECTORY_URI . '/assets/css/elements.type.css' ,null, STARTER_VERSION, 'screen' );
	wp_enqueue_style( 'starter-theme-forms', STARTER_DIRECTORY_URI . '/assets/css/elements.forms.css' ,null, STARTER_VERSION, 'screen' );

	/* Objects */
	wp_enqueue_style( 'starter-theme-pagination', STARTER_DIRECTORY_URI . '/assets/css/object.pagination.css' ,null, STARTER_VERSION, 'screen' );

	/* Components */
	wp_enqueue_style( 'starter-theme-header', STARTER_DIRECTORY_URI . '/assets/css/components.header.css' ,null, STARTER_VERSION, 'screen' );
	wp_enqueue_style( 'starter-theme-sidebar', STARTER_DIRECTORY_URI . '/assets/css/components.sidebar.css' ,null, STARTER_VERSION, 'screen' );
	wp_enqueue_style( 'starter-theme-nav', STARTER_DIRECTORY_URI . '/assets/css/components.nav.css' ,null, STARTER_VERSION, 'screen' );
	wp_enqueue_style( 'starter-theme-post', STARTER_DIRECTORY_URI . '/assets/css/components.post.css' ,null, STARTER_VERSION, 'screen' );
	wp_enqueue_style( 'starter-theme-footer', STARTER_DIRECTORY_URI . '/assets/css/components.footer.css' ,null, STARTER_VERSION, 'screen' );

	/* WooCommerce */
	if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
		wp_enqueue_style( 'starter-theme-product', STARTER_DIRECTORY_URI . '/assets/css/object.product.css' ,null, STARTER_VERSION, 'screen' );
		wp_enqueue_style( 'starter-theme-shop-loop', STARTER_DIRECTORY_URI . '/assets/css/object.shoploop.css' ,null, STARTER_VERSION, 'screen' );
		wp_enqueue_style( 'starter-theme-shop-gallery', STARTER_DIRECTORY_URI . '/assets/css/object.productgallery.css' ,null, STARTER_VERSION, 'screen' );
		wp_enqueue_style( 'starter-theme-shop-checkout', STARTER_DIRECTORY_URI . '/assets/css/components.checkout.css' ,null, STARTER_VERSION, 'screen' );
		wp_enqueue_style( 'starter-theme-shop-cart', STARTER_DIRECTORY_URI . '/assets/css/components.cart.css' ,null, STARTER_VERSION, 'screen' );
		wp_enqueue_style( 'starter-theme-shop-account', STARTER_DIRECTORY_URI . '/assets/css/components.account.css' ,null, STARTER_VERSION, 'screen' );
	}

	/* Trumps */
	wp_enqueue_style( 'starter-style', STARTER_DIRECTORY_URI . '/style.css' ,null, STARTER_VERSION, 'screen' );

	/* JS */
	wp_enqueue_script( 'starter-script', STARTER_DIRECTORY_URI . '/assets/js/script.js', array(), STARTER_VERSION, true );

	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'html5shiv', STARTER_DIRECTORY_URI . '/assets/js/html5-shiv.min.js', array(), '3.7.2', false );
	add_filter( 'script_loader_tag', function( $tag, $handle ) {
		if ( 'html5shiv' === $handle ) :
			$tag = "<!--[if lt IE 9]>$tag<![endif]-->";
		endif;
		return $tag;
	}, 10, 2 );

}
add_action( 'wp_enqueue_scripts', 'starter_theme_scripts' );

// Remove height and width attributes.
add_filter( 'post_thumbnail_html', 'starter_remove_image_attributes', 10 );
add_filter( 'image_send_to_editor', 'starter_remove_image_attributes', 10 );
add_filter( 'get_custom_logo', 'starter_remove_image_attributes', 10 );
add_filter( 'img_caption_shortcode', 'starter_remove_image_attributes' , 10 );
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'starter_remove_image_attributes', 10 );

/**
 * Sets up the theme menus and configurables
 *
 * @access  public
 * @since   1.0.0
 * @param 	array $html The html which is used to display images on the front end.
 */
function starter_remove_image_attributes( $html ) {
	$html = preg_replace( '/(width|height)="\d*"\s/', '', $html );
	return $html;
}

/**
 * Sets up the theme menus and configurables
 *
 * @access  public
 * @since   1.0.0
 * @return 	array
 */
function starter_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if ( false === empty( $custom_logo ) ) {
		$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		return $image[0];
	}
}

require_once( STARTER_THEME_INC . '/inc/customiser.php' );
require_once( STARTER_THEME_INC . '/inc/template-tags.php' );

if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	require_once( STARTER_THEME_INC . '/inc/woocommerce.php' );
}
