<?php
/**
 * Wyvex Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Theme Name
 */

define( 'MS_VERSION', '1.0.0-beta1' );
define( 'MS_DIRECTORY_URI', get_template_directory_uri() );
define( 'MS_THEME_INC', get_template_directory() );

	
function ms_theme_setup() 
{
	//Navigation Menus
	register_nav_menus( array(
		'main_menu' => esc_html__( 'Main Menu', 'ms-theme' ),
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
	add_theme_support( 'cookie-bot' );

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
add_action( 'after_setup_theme', 'ms_theme_setup' );

function prefix_remove_css_section( $wp_customize ) {
	$wp_customize->remove_section( 'custom_css' );
}
add_action( 'customize_register', 'prefix_remove_css_section', 15 );

function ms_sidebars() {
	register_sidebar( array( 
		'name' => 'Site Sidebar',
		'id' => 'site-sidebar', 
		'description'   => __( 'Add widgets to the sidebar throughout the site.', 'wyvex' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>', 
	) );	
}
add_action( 'widgets_init', 'ms_sidebars' );

function ms_gallery_atts( $output, $pairs, $atts ) {
	$output['size'] = 'medium';

	return $output;
}
add_filter( 'shortcode_atts_gallery', 'ms_gallery_atts', 10, 3 );

function ms_theme_scripts() 
{
	/* CSS*/

	/* Generic */
	wp_enqueue_style( 'ms-theme-helper', trailingslashit( MS_DIRECTORY_URI ) . 'assets/css/generic.helper.css' ,array(), MS_VERSION, 'all' );		
	wp_enqueue_style( 'ms-theme-reset', trailingslashit( MS_DIRECTORY_URI ) . 'assets/css/generic.reset.css' ,array(), MS_VERSION, 'screen' );
	wp_enqueue_style( 'ms-theme-settings', trailingslashit( MS_DIRECTORY_URI ) . 'assets/css/settings.global.css' ,array(), MS_VERSION, 'screen' );		

	/* Elements */ 
	wp_enqueue_style( 'ms-theme-type', trailingslashit( MS_DIRECTORY_URI ) . 'assets/css/elements.type.css' ,array('ms-theme-settings'), MS_VERSION, 'screen' );	
	wp_enqueue_style( 'ms-theme-forms', trailingslashit( MS_DIRECTORY_URI ) . 'assets/css/elements.forms.css' ,array('ms-theme-type'), MS_VERSION, 'screen' );	

	/* Objects */
	wp_enqueue_style( 'ms-theme-media', trailingslashit( MS_DIRECTORY_URI ) . 'assets/css/object-media.css' ,array(), MS_VERSION, 'screen' );	

	/* Components */
	wp_enqueue_style( 'ms-theme-header', trailingslashit( MS_DIRECTORY_URI ) . 'assets/css/components.header.css' ,array(), MS_VERSION, 'screen' );	
	wp_enqueue_style( 'ms-theme-sidebar', trailingslashit( MS_DIRECTORY_URI ) . 'assets/css/components.sidebar.css' ,array(), MS_VERSION, 'screen' );	
	wp_enqueue_style( 'ms-theme-nav', trailingslashit( MS_DIRECTORY_URI ) . 'assets/css/components.nav.css' ,array(), MS_VERSION, 'screen' );	
	wp_enqueue_style( 'ms-theme-post', trailingslashit( MS_DIRECTORY_URI ) . 'assets/css/components.post.css' ,array(), MS_VERSION, 'screen' );	
	wp_enqueue_style( 'ms-theme-footer', trailingslashit( MS_DIRECTORY_URI ) . 'assets/css/components.footer.css' ,array(), MS_VERSION, 'screen' );	
	
	//Trumps
	wp_enqueue_style( 'starter-style', trailingslashit( MS_DIRECTORY_URI ) . 'style.css' ,array(), MS_VERSION, 'screen' );	

	/* JS */
	wp_enqueue_script( 'starter-script', trailingslashit( MS_DIRECTORY_URI ) . 'assets/js/script.js', array(), MS_VERSION, true );
	
	wp_enqueue_script( 'html5shiv', trailingslashit( MS_DIRECTORY_URI ) . 'assets/js/html5-shiv.js', array(), '3.7.2', false );
	add_filter( 'script_loader_tag', function( $tag, $handle ) 
	{
	    if ( $handle === 'html5shiv' ) :
	        $tag = "<!--[if lt IE 9]>$tag<![endif]-->";
	    endif;
	    return $tag;
	}, 10, 2 );

}
add_action( 'wp_enqueue_scripts', 'ms_theme_scripts' );

//Remove height and width attributes
add_filter( 'post_thumbnail_html', 'ms_remove_image_attributes', 10 );
add_filter( 'image_send_to_editor', 'ms_remove_image_attributes', 10 );
add_filter( 'get_custom_logo', 'ms_remove_image_attributes', 10 );
add_filter( 'img_caption_shortcode', 'ms_remove_image_attributes' , 10 );

function ms_remove_image_attributes( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

function ms_logo() {
	$custom_logo_id = get_ms_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	return $image[0];
}

require_once ( MS_THEME_INC . '/inc/customiser.php' );
require_once ( MS_THEME_INC . '/inc/template-tags.php' );