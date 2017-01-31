<?php
/**
 * MotoScene Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package MotoScene Theme
 */

define( 'MS_VERSION', '1.0.0-beta9' );
define( 'MS_DIRECTORY_URI', get_template_directory_uri() );
define( 'MS_THEME_INC', get_template_directory() );
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	
function wyvex_theme_setup() 
{
	//Navigation Menus
	register_nav_menus( array(
		'mini_header' => esc_html__( 'Mini Header Menu', 'ms-theme' ),
		'primary' => esc_html__( 'Primary Menu', 'ms-theme' ),
		'full_menu' => esc_html__( 'All Sections', 'ms-theme' ),
		'editions' => esc_html__( 'Editions Menu', 'ms-theme' ),
		'footer' => esc_html__( 'Footer Menu', 'ms-theme' ),
	) );
	
	//Theme Support
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );		
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'gallery', 'video' ) );

	add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );		

	//Customisation
	add_theme_support( 'custom-logo', array( 'width' => 430, 'flex-height' => true, ) );
	add_theme_support( 'colors' );
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

	if ( is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) :
		add_theme_support( 'dfp', array(
		    'network' => get_field( 'dfp_network', 'option' ),
		    'zepto'	  => true
		) );
	endif;
	add_filter( 'wpc_dfp_zone', 'wpc_get_site_slug' );

	if( function_exists('acf_add_options_page') ) :
		
		acf_add_options_page();
		
	endif;

	define('WPCF7_AUTOP', false);

	/* Image sizes */
	add_image_size( 'category_block', 316, 169 );
}

add_action( 'after_setup_theme', 'wyvex_theme_setup' );

function wyvex_sidebars() {
	register_sidebar( array( 
		'name' => 'Site Sidebar',
		'id' => 'site-sidebar', 
		'description'   => __( 'Add widgets to the sidebar throughout the site.', 'wyvex' ),
		'before_widget' => '<div class="widget top-border-color %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>', 
	) );	
}
add_action( 'widgets_init', 'wyvex_sidebars' );

function wyvex_gallery_atts( $output, $pairs, $atts ) {
	$output['size'] = 'medium';

	return $output;
}
add_filter( 'shortcode_atts_gallery', 'wyvex_gallery_atts', 10, 3 );

function wyvex_theme_scripts() 
{
	/* CSS*/

	/* Generic */
	wp_enqueue_style( 'ms-theme-helper', MS_DIRECTORY_URI . '/assets/css/generic.helper.css' ,null, MS_VERSION, 'all' );	
	wp_enqueue_style( 'ms-theme-print', MS_DIRECTORY_URI . '/assets/css/print.css' ,null, MS_VERSION, 'print' );
	wp_enqueue_style( 'ms-theme-reset', MS_DIRECTORY_URI . '/assets/css/generic.reset.css' ,null, MS_VERSION, 'screen' );
	wp_enqueue_style( 'ms-theme-settings', MS_DIRECTORY_URI . '/assets/css/settings.global.css' ,null, MS_VERSION, 'screen' );		

	/* Elements */
	wp_enqueue_style( 'wyvex-google-font', '//fonts.googleapis.com/css?family=Droid+Sans:400,700|Montserrat', null, MS_VERSION, 'all' );
	wp_enqueue_style( 'ms-theme-type', MS_DIRECTORY_URI . '/assets/css/elements.type.css' ,null, MS_VERSION, 'screen' );	
	wp_enqueue_style( 'ms-theme-forms', MS_DIRECTORY_URI . '/assets/css/elements.forms.css' ,null, MS_VERSION, 'screen' );	

	/* Objects */
	wp_enqueue_style( 'ms-theme-category', MS_DIRECTORY_URI . '/assets/css/object-category.css' ,null, MS_VERSION, 'screen' );	
	wp_enqueue_style( 'ms-theme-jobs', MS_DIRECTORY_URI . '/assets/css/object-jobs-widget.css' ,null, MS_VERSION, 'screen' );	
	wp_enqueue_style( 'ms-theme-signup', MS_DIRECTORY_URI . '/assets/css/object-signupform.css' ,null, MS_VERSION, 'screen' );	
	wp_enqueue_style( 'ms-theme-popular', MS_DIRECTORY_URI . '/assets/css/object-popular-widget.css' ,null, MS_VERSION, 'screen' );	
	wp_enqueue_style( 'ms-theme-media', MS_DIRECTORY_URI . '/assets/css/object-media.css' ,null, MS_VERSION, 'screen' );	
	wp_enqueue_style( 'ms-theme-gallery', MS_DIRECTORY_URI . '/assets/css/object-gallery.css' ,null, MS_VERSION, 'screen' );	
	wp_enqueue_style( 'ms-theme-packages', MS_DIRECTORY_URI . '/assets/css/object-packages.css' ,null, MS_VERSION, 'screen' );	

	/* Components */
	wp_enqueue_style( 'ms-theme-header', MS_DIRECTORY_URI . '/assets/css/components.header.css' ,null, MS_VERSION, 'screen' );	
	wp_enqueue_style( 'ms-theme-sidebar', MS_DIRECTORY_URI . '/assets/css/components.sidebar.css' ,null, MS_VERSION, 'screen' );	
	wp_enqueue_style( 'ms-theme-nav', MS_DIRECTORY_URI . '/assets/css/components.nav.css' ,null, MS_VERSION, 'screen' );	
	wp_enqueue_style( 'ms-theme-post', MS_DIRECTORY_URI . '/assets/css/components.post.css' ,null, MS_VERSION, 'screen' );	
	wp_enqueue_style( 'ms-theme-footer', MS_DIRECTORY_URI . '/assets/css/components.footer.css' ,null, MS_VERSION, 'screen' );	
	wp_enqueue_style( 'ms-theme-contact', MS_DIRECTORY_URI . '/assets/css/components.contactform.css' ,null, MS_VERSION, 'screen' );	
	wp_enqueue_style( 'ms-theme-elas', MS_DIRECTORY_URI . '/assets/css/components.elas.css' ,null, MS_VERSION, 'screen' );		
	wp_enqueue_style( 'ms-theme-competitions', MS_DIRECTORY_URI . '/assets/css/components.competitions.css' ,null, MS_VERSION, 'screen' );	

	//Trumps
	wp_enqueue_style( 'wyvex-style', MS_DIRECTORY_URI . '/style.css' ,null, MS_VERSION, 'screen' );	

	/* JS */
	wp_enqueue_script( 'zepto', MS_DIRECTORY_URI . '/assets/js/zepto-1.2.0.js', array(), MS_VERSION, true );
	wp_enqueue_script( 'wyvex-script', MS_DIRECTORY_URI . '/assets/js/script.js', array(), MS_VERSION, true );

	if ( false === is_admin() && is_single() ) :
		wp_enqueue_script( 'wyvex-fbcomments', MS_DIRECTORY_URI . '/assets/js/fbcomments.js', array(), MS_VERSION, true );
	endif;
	
	//Remove scripts
	if ( !is_admin() ) :
		wp_deregister_script('jquery');
	endif;

	wp_enqueue_script( 'html5shiv', MS_DIRECTORY_URI . '/assets/js/html5-shiv.js', array(), '3.7.2', false );
	add_filter( 'script_loader_tag', function( $tag, $handle ) 
	{
	    if ( $handle === 'html5shiv' ) :
	        $tag = "<!--[if lt IE 9]>$tag<![endif]-->";
	    endif;
	    return $tag;
	}, 10, 2 );

}
add_action( 'wp_enqueue_scripts', 'wyvex_theme_scripts' );

//Remove height and width attributes
add_filter( 'post_thumbnail_html', 'wyvex_remove_image_attributes', 10 );
add_filter( 'image_send_to_editor', 'wyvex_remove_image_attributes', 10 );
add_filter( 'get_custom_logo', 'wyvex_remove_image_attributes', 10 );
add_filter( 'img_caption_shortcode', 'wyvex_remove_image_attributes' , 10 );

function wyvex_remove_image_attributes( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

require_once ( MS_THEME_INC . '/inc/customiser.php' );
require_once ( MS_THEME_INC . '/inc/template-tags.php' );