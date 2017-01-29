<?php
/**
 * GP Web Design 2016 functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package GP Web Design 2017
 */

define( 'GP_VERSION', '1.0.0-beta1' );
define( 'GP_DIRECTORY_URI', get_template_directory_uri() );
define( 'GP_THEME_INC', get_template_directory() );

function gp_setup() 
{
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'primary' => esc_html__( 'Main Menu', 'gp-theme' ),
		'footer' => esc_html__( 'Footer Menu', 'gp-theme' ),
	) );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
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

}
add_action( 'after_setup_theme', 'gp_setup' );

function gp_widgets_init() 
{
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'gp-theme' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'gp_widgets_init' );

function gp_scripts() 
{
	/* Generic */
	wp_enqueue_style( 'gp-theme-helper', GP_DIRECTORY_URI . '/assets/css/generic.helper.css' ,null, GP_VERSION, 'all' );	
	wp_enqueue_style( 'gp-theme-print', GP_DIRECTORY_URI . '/assets/css/generic.print.css' ,null, GP_VERSION, 'print' );
	wp_enqueue_style( 'gp-theme-reset', GP_DIRECTORY_URI . '/assets/css/generic.reset.css' ,null, GP_VERSION, 'screen' );
	wp_enqueue_style( 'gp-theme-fonts', 'http://fonts.googleapis.com/css?family=Old+Standard+TT:400,700|Lato:400,700' ,null, GP_VERSION, 'screen' );
    wp_enqueue_style( 'gp-theme-icons', GP_DIRECTORY_URI . '/assets/css/themify-icons.css' ,null, GP_VERSION, 'screen' );
        
	wp_enqueue_style( 'gp-theme-settings', GP_DIRECTORY_URI . '/assets/css/settings.global.css' ,null, GP_VERSION, 'screen' );		
	
	/* Elements */
	wp_enqueue_style( 'gp-theme-type', GP_DIRECTORY_URI . '/assets/css/elements.type.css' ,null, GP_VERSION, 'screen' );
		
	/* Objects */
	
	/* Components */
	wp_enqueue_style( 'gp-theme-header', GP_DIRECTORY_URI . '/assets/css/components.header.css' ,null, GP_VERSION, 'screen' );
	wp_enqueue_style( 'gp-theme-nav', GP_DIRECTORY_URI . '/assets/css/components.nav.css' ,null, GP_VERSION, 'screen' );
	wp_enqueue_style( 'gp-theme-footer', GP_DIRECTORY_URI . '/assets/css/components.footer.css' ,null, GP_VERSION, 'screen' );
	
	//Trumps
	wp_enqueue_style( 'gp-style', GP_DIRECTORY_URI . '/style.css' ,null, GP_VERSION, 'screen' );	


	/* Scripts */
	wp_enqueue_script( 'gp-theme-navigation', GP_DIRECTORY_URI . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'gp-theme-skip-link-focus-fix', GP_DIRECTORY_URI . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'gp-theme-modernizr', GP_DIRECTORY_URI . '/js/modernizr.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) 
	{
		wp_enqueue_script( 'comment-reply' );
	}
} 

add_action( 'wp_enqueue_scripts', 'gp_scripts' );

//require_once( GP_DIRECTORY_URI . '/inc/template-tags.php' );
