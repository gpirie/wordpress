<?php
/**
 * Wyvex Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Theme Name
 */

define( 'STARTER_VERSION', '1.0.0-beta1' );
define( 'STARTER_DIRECTORY_URI', get_template_directory_uri() );
define( 'STARTER_THEME_INC', get_template_directory() );

	
function starter_theme_setup() 
{
	//Navigation Menus
	register_nav_menus( array(
		'main_menu' => esc_html__( 'Main Menu', 'starter-theme' ),
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

	//DFP
	if ( get_theme_mod( 'dfp_network' ) ) 
	{
		add_theme_support( 'dfp', array(
		    'network' => get_theme_mod( 'dfp_network' )
		) );
	}

}
add_action( 'after_setup_theme', 'starter_theme_setup' );

function prefix_remove_css_section( $wp_customize ) {
	$wp_customize->remove_section( 'custom_css' );
}
add_action( 'customize_register', 'prefix_remove_css_section', 15 );

function starter_sidebars() {
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
add_action( 'widgets_init', 'starter_sidebars' );

function starter_gallery_atts( $output, $pairs, $atts ) {
	$output['size'] = 'medium';

	return $output;
}
add_filter( 'shortcode_atts_gallery', 'starter_gallery_atts', 10, 3 );

function starter_theme_scripts() 
{
	/* CSS*/

	/* Generic */
	wp_enqueue_style( 'starter-theme-helper', trailingslashit( STARTER_DIRECTORY_URI ) . 'assets/css/generic.helper.css' ,array(), STARTER_VERSION, 'all' );		
	wp_enqueue_style( 'starter-theme-reset', trailingslashit( STARTER_DIRECTORY_URI ) . 'assets/css/generic.reset.css' ,array(), STARTER_VERSION, 'screen' );
	wp_enqueue_style( 'starter-theme-settings', trailingslashit( STARTER_DIRECTORY_URI ) . 'assets/css/settings.global.css' ,array(), STARTER_VERSION, 'screen' );		

	/* Elements */ 
	wp_enqueue_style( 'starter-theme-domine', '//fonts.googleapis.com/css?family=Domine:400,700' ,array(), STARTER_VERSION, 'all' );
	wp_enqueue_style( 'starter-theme-type', trailingslashit( STARTER_DIRECTORY_URI ) . 'assets/css/elements.type.css' ,array('starter-theme-settings'), STARTER_VERSION, 'screen' );	
	wp_enqueue_style( 'starter-theme-forms', trailingslashit( STARTER_DIRECTORY_URI ) . 'assets/css/elements.forms.css' ,array('starter-theme-type'), STARTER_VERSION, 'screen' );	

	/* Objects */
	wp_enqueue_style( 'starter-theme-media', trailingslashit( STARTER_DIRECTORY_URI ) . 'assets/css/object-media.css' ,array(), STARTER_VERSION, 'screen' );	

	/* Components */
	wp_enqueue_style( 'starter-theme-header', trailingslashit( STARTER_DIRECTORY_URI ) . 'assets/css/components.header.css' ,array(), STARTER_VERSION, 'screen' );	
	wp_enqueue_style( 'starter-theme-sidebar', trailingslashit( STARTER_DIRECTORY_URI ) . 'assets/css/components.sidebar.css' ,array(), STARTER_VERSION, 'screen' );	
	wp_enqueue_style( 'starter-theme-nav', trailingslashit( STARTER_DIRECTORY_URI ) . 'assets/css/components.nav.css' ,array(), STARTER_VERSION, 'screen' );	
	wp_enqueue_style( 'starter-theme-post', trailingslashit( STARTER_DIRECTORY_URI ) . 'assets/css/components.post.css' ,array(), STARTER_VERSION, 'screen' );	
	wp_enqueue_style( 'starter-theme-footer', trailingslashit( STARTER_DIRECTORY_URI ) . 'assets/css/components.footer.css' ,array(), STARTER_VERSION, 'screen' );	
	
	//Trumps
	wp_enqueue_style( 'starter-style', trailingslashit( STARTER_DIRECTORY_URI ) . 'style.css' ,array(), STARTER_VERSION, 'screen' );	

	/* JS */
	wp_enqueue_script( 'starter-script', trailingslashit( STARTER_DIRECTORY_URI ) . 'assets/js/script.js', array(), STARTER_VERSION, true );
	
	wp_enqueue_script( 'html5shiv', trailingslashit( STARTER_DIRECTORY_URI ) . 'assets/js/html5-shiv.js', array(), '3.7.2', false );
	add_filter( 'script_loader_tag', function( $tag, $handle ) 
	{
	    if ( $handle === 'html5shiv' ) :
	        $tag = "<!--[if lt IE 9]>$tag<![endif]-->";
	    endif;
	    return $tag;
	}, 10, 2 );

}
add_action( 'wp_enqueue_scripts', 'starter_theme_scripts' );

//Remove height and width attributes
add_filter( 'post_thumbnail_html', 'starter_remove_image_attributes', 10 );
add_filter( 'image_send_to_editor', 'starter_remove_image_attributes', 10 );
add_filter( 'get_custom_logo', 'starter_remove_image_attributes', 10 );
add_filter( 'img_caption_shortcode', 'starter_remove_image_attributes' , 10 );

function starter_remove_image_attributes( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

function starter_logo() {
	$custom_logo_id = get_starter_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	return $image[0];
}

require_once ( STARTER_THEME_INC . '/inc/customiser.php' );
require_once ( STARTER_THEME_INC . '/inc/template-tags.php' );