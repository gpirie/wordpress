<?php

/**
 * Starter Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package ICTFC Theme
 */

defined( 'ABSPATH' ) or die( 'Nice try' );

define( 'ICT_VERSION', '1.0.0-beta1' );
define( 'ICT_DIRECTORY_URI', get_template_directory_uri() );
define( 'ICT_THEME_INC', get_template_directory() );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

function ict_theme_setup()
{
	//Navigation Menus
	register_nav_menus( array(
		'main_menu' => esc_html__( 'Main Menu', 'ictfc-theme' ),
		'footer_menu' => esc_html__( 'Footer Menu', 'ictfc-theme' ),
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

}
add_action( 'after_setup_theme', 'ict_theme_setup' );

function ict_customizer_remove_css_section( $wp_customize ) {
	$wp_customize->remove_section( 'custom_css' );
}
add_action( 'customize_register', 'ict_customizer_remove_css_section', 15 );

function ict_sidebars() {
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
add_action( 'widgets_init', 'ict_sidebars' );

function ict_gallery_atts( $output, $pairs, $atts ) {
	$output['size'] = 'medium';

	return $output;
}
add_filter( 'shortcode_atts_gallery', 'ict_gallery_atts', 10, 3 );

function ict_theme_scripts()
{
	/* CSS*/

	/* Generic */
	wp_enqueue_style( 'ictfc-theme-helper', ICT_DIRECTORY_URI . '/assets/css/generic.helper.css' ,null, ICT_VERSION, 'all' );
	wp_enqueue_style( 'ictfc-theme-reset', ICT_DIRECTORY_URI . '/assets/css/generic.reset.css' ,null, ICT_VERSION, 'all' );
	wp_enqueue_style( 'ictfc-theme-settings', ICT_DIRECTORY_URI . '/assets/css/settings.global.css' ,null, ICT_VERSION, 'screen' );
	wp_enqueue_style( 'ictfc-fonts', '//fonts.googleapis.com/css?family=Lato:700|Merriweather:400,400i,700', null, 'screen' );

	/* Elements */
	wp_enqueue_style( 'ictfc-theme-headings', ICT_DIRECTORY_URI . '/assets/css/elements.headings.css' ,null, ICT_VERSION, 'screen' );
	wp_enqueue_style( 'ictfc-theme-type', ICT_DIRECTORY_URI . '/assets/css/elements.type.css' ,null, ICT_VERSION, 'screen' );
	wp_enqueue_style( 'ictfc-theme-forms', ICT_DIRECTORY_URI . '/assets/css/elements.forms.css' ,null, ICT_VERSION, 'screen' );

	/* Objects */
	wp_enqueue_style( 'ictfc-theme-pagination', ICT_DIRECTORY_URI . '/assets/css/object.pagination.css' ,null, ICT_VERSION, 'screen' );

	/* Components */
	wp_enqueue_style( 'ictfc-theme-header', ICT_DIRECTORY_URI . '/assets/css/components.header.css' ,null, ICT_VERSION, 'screen' );
	wp_enqueue_style( 'ictfc-theme-sidebar', ICT_DIRECTORY_URI . '/assets/css/components.sidebar.css' ,null, ICT_VERSION, 'screen' );
	wp_enqueue_style( 'ictfc-theme-nav', ICT_DIRECTORY_URI . '/assets/css/components.nav.css' ,null, ICT_VERSION, 'screen' );
	wp_enqueue_style( 'ictfc-theme-post', ICT_DIRECTORY_URI . '/assets/css/components.post.css' ,null, ICT_VERSION, 'screen' );
	wp_enqueue_style( 'ictfc-theme-footer', ICT_DIRECTORY_URI . '/assets/css/components.footer.css' ,null, ICT_VERSION, 'screen' );

	/* Trumps */
	wp_enqueue_style( 'ictfc-style', ICT_DIRECTORY_URI . '/style.css' ,null, ICT_VERSION, 'screen' );

	/* JS */
	wp_enqueue_script( 'ictfc-script', ICT_DIRECTORY_URI . '/assets/js/script.js', array(), ICT_VERSION, true );

	wp_enqueue_script( 'html5shiv', ICT_DIRECTORY_URI . '/assets/js/html5-shiv.js', array(), '3.7.2', false );
	add_filter( 'script_loader_tag', function( $tag, $handle )
	{
	    if ( $handle === 'html5shiv' ) :
	        $tag = "<!--[if lt IE 9]>$tag<![endif]-->";
	    endif;
	    return $tag;
	}, 10, 2 );

}
add_action( 'wp_enqueue_scripts', 'ict_theme_scripts' );

//Remove height and width attributes
add_filter( 'post_thumbnail_html', 'ict_remove_image_attributes', 10 );
add_filter( 'image_send_to_editor', 'ict_remove_image_attributes', 10 );
add_filter( 'get_custom_logo', 'ict_remove_image_attributes', 10 );
add_filter( 'img_caption_shortcode', 'ict_remove_image_attributes' , 10 );

function ict_remove_image_attributes( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

require_once ( ICT_THEME_INC . '/inc/customiser.php' );
require_once ( ICT_THEME_INC . '/inc/template-tags.php' );

if( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	require_once ( ICT_THEME_INC . '/inc/woocommerce.php' );
}
