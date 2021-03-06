<?php
/**
 * Wyvex Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Theme Name
 */

define( 'GPWD_VERSION', '1.0.0-beta1' );
define( 'GPWD_DIRECTORY_URI', get_template_directory_uri() );
define( 'GPWD_THEME_INC', get_template_directory() );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

function gpwd_theme_setup()
{
	//Navigation Menus
	register_nav_menus( array(
		'main_menu' => esc_html__( 'Main Menu', 'gpwd-theme' ),
		'footer_menu' => esc_html__( 'Footer Menu', 'gpwd-theme' ),
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

	add_image_size( 'portfolio_thumb', 300, 160 );

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
add_action( 'after_setup_theme', 'gpwd_theme_setup' );

function prefix_remove_css_section( $wp_customize ) {
	$wp_customize->remove_section( 'custom_css' );
}
add_action( 'customize_register', 'prefix_remove_css_section', 15 );

function gpwd_sidebars() {
	register_sidebar( array(
		'name' => 'Site Sidebar',
		'id' => 'site-sidebar',
		'description'   => __( 'Add widgets to the sidebar throughout the site.', 'wyvex' ),
		'before_widget' => '<div class="o-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="o-widget__title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'gpwd_sidebars' );

function gpwd_gallery_atts( $output, $pairs, $atts ) {
	$output['size'] = 'medium';

	return $output;
}
add_filter( 'shortcode_atts_gallery', 'gpwd_gallery_atts', 10, 3 );

function gpwd_theme_scripts()
{
	/* CSS*/

	/* Generic */
	wp_enqueue_style( 'gpwd-theme-helper', GPWD_DIRECTORY_URI . '/assets/css/generic.helper.css' ,null, GPWD_VERSION, 'all' );
	wp_enqueue_style( 'gpwd-theme-reset', GPWD_DIRECTORY_URI . '/assets/css/generic.reset.css' ,null, GPWD_VERSION, 'all' );
	wp_enqueue_style( 'gpwd-theme-settings', GPWD_DIRECTORY_URI . '/assets/css/settings.global.css' ,null, GPWD_VERSION, 'screen' );

	/* Elements */
	wp_enqueue_style( 'gpwd-theme-headings', GPWD_DIRECTORY_URI . '/assets/css/elements.headings.css' ,null, GPWD_VERSION, 'screen' );
	wp_enqueue_style( 'gpwd-theme-type', GPWD_DIRECTORY_URI . '/assets/css/elements.type.css' ,null, GPWD_VERSION, 'screen' );
	wp_enqueue_style( 'gpwd-theme-forms', GPWD_DIRECTORY_URI . '/assets/css/elements.forms.css' ,null, GPWD_VERSION, 'screen' );
	wp_enqueue_style( 'gpwd-theme-gfonts', '//fonts.googleapis.com/css?family=Lora:400,400i,700,700i|Nunito:700' ,null, GPWD_VERSION, 'screen' );

	/* Objects */
	wp_enqueue_style( 'gpwd-theme-pagination', GPWD_DIRECTORY_URI . '/assets/css/object.pagination.css' ,null, GPWD_VERSION, 'screen' );
	wp_enqueue_style( 'gpwd-theme-object-portfolio', GPWD_DIRECTORY_URI . '/assets/css/object.portfolio.css' ,null, GPWD_VERSION, 'screen' );
	wp_enqueue_style( 'gpwd-theme-object-snippets', GPWD_DIRECTORY_URI . '/assets/css/object.snippets.css' ,null, GPWD_VERSION, 'screen' );

	/* Components */
	wp_enqueue_style( 'gpwd-theme-header', GPWD_DIRECTORY_URI . '/assets/css/components.header.css' ,null, GPWD_VERSION, 'screen' );
	wp_enqueue_style( 'gpwd-theme-sidebar', GPWD_DIRECTORY_URI . '/assets/css/components.sidebar.css' ,null, GPWD_VERSION, 'screen' );
	wp_enqueue_style( 'gpwd-theme-nav', GPWD_DIRECTORY_URI . '/assets/css/components.nav.css' ,null, GPWD_VERSION, 'screen' );
	wp_enqueue_style( 'gpwd-theme-post', GPWD_DIRECTORY_URI . '/assets/css/components.post.css' ,null, GPWD_VERSION, 'screen' );
	wp_enqueue_style( 'gpwd-theme-footer', GPWD_DIRECTORY_URI . '/assets/css/components.footer.css' ,null, GPWD_VERSION, 'screen' );

	/* Blocks */
	wp_enqueue_style( 'gpwd-theme-block-text', GPWD_DIRECTORY_URI . '/assets/css/block.text.css' ,null, GPWD_VERSION, 'screen' );
	wp_enqueue_style( 'gpwd-theme-block-services', GPWD_DIRECTORY_URI . '/assets/css/block.services.css' ,null, GPWD_VERSION, 'screen' );
	wp_enqueue_style( 'gpwd-theme-block-featured', GPWD_DIRECTORY_URI . '/assets/css/block.featured.css' ,null, GPWD_VERSION, 'screen' );
	wp_enqueue_style( 'gpwd-theme-block-portfolio', GPWD_DIRECTORY_URI . '/assets/css/block.portfolio.css' ,null, GPWD_VERSION, 'screen' );

	wp_enqueue_style( 'gpwd-theme-prism', GPWD_DIRECTORY_URI . '/assets/css/prism.css' ,null, GPWD_VERSION, 'screen' );

	/* Trumps */
	wp_enqueue_style( 'gpwd-theme-style', GPWD_DIRECTORY_URI . '/style.css' ,null, GPWD_VERSION, 'screen' );

	/* JS */
	wp_enqueue_script( 'gpwd-theme-script', GPWD_DIRECTORY_URI . '/assets/js/script.js', array(), GPWD_VERSION, true );

	wp_enqueue_script( 'html5shiv', GPWD_DIRECTORY_URI . '/assets/js/html5-shiv.js', array(), '3.7.2', false );
	wp_enqueue_script( 'gpwd-prism', GPWD_DIRECTORY_URI . '/assets/js/prism.js', array(), false );

	add_filter( 'script_loader_tag', function( $tag, $handle )
	{
	    if ( $handle === 'html5shiv' ) :
	        $tag = "<!--[if lt IE 9]>$tag<![endif]-->";
	    endif;
	    return $tag;
	}, 10, 2 );

}
add_action( 'wp_enqueue_scripts', 'gpwd_theme_scripts' );

//Remove height and width attributes
add_filter( 'post_thumbnail_html', 'gpwd_remove_image_attributes', 10 );
add_filter( 'image_send_to_editor', 'gpwd_remove_image_attributes', 10 );
add_filter( 'get_custom_logo', 'gpwd_remove_image_attributes', 10 );
add_filter( 'img_caption_shortcode', 'gpwd_remove_image_attributes' , 10 );

function gpwd_remove_image_attributes( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

function gpwd_logo() {
	$custom_logo_id = get_gpwd_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	return $image[0];
}

require_once ( GPWD_THEME_INC . '/inc/customiser.php' );
require_once ( GPWD_THEME_INC . '/inc/template-tags.php' );
