<?php
/*
Plugin Name: GP Web Design Custom Post Types
Plugin URI: http://www.graemepirie.com
Description: A plugin which allows for custom post types to be used
Version: 1.0.0
Author: Graeme Pirie
Author URI: http://www.graemepirie.com
License: GPL2
*/

defined('ABSPATH') or die('Nope!');

function gpwd_custom_post_type_activation() {
  gpwd_custom_post_type_init();
  flush_rewrite_rules( false );
}

function gpwd_custom_post_type_deactivation() {
  flush_rewrite_rules( false );
}

register_activation_hook( __FILE__, 'gpwd_custom_post_type_activation' );
register_deactivation_hook( __FILE__, 'gpwd_custom_post_type_deactivation' );

// Register Custom Post Type
function gpwd_custom_post_type_init() {
  
   $labels = array(
      'name'                => _x( 'Portfolio', 'Post Type General Name', 'text_domain' ),
      'singular_name'       => _x( 'Portfolio', 'Post Type Singular Name', 'text_domain' ),
      'menu_name'           => __( 'Portfolio', 'text_domain' ),
      'name_admin_bar'      => __( 'Portfolio', 'text_domain' ),
      'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
      'all_items'           => __( 'All Items', 'text_domain' ),
      'add_new_item'        => __( 'Add Portfolio Item', 'text_domain' ),
      'add_new'             => __( 'Add New', 'text_domain' ),
      'new_item'            => __( 'New Item', 'text_domain' ),
      'edit_item'           => __( 'Edit Item', 'text_domain' ),
      'update_item'         => __( 'Update Item', 'text_domain' ),
      'view_item'           => __( 'View Item', 'text_domain' ),
      'search_items'        => __( 'Search Item', 'text_domain' ),
      'not_found'           => __( 'Not found', 'text_domain' ),
      'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
    );
    $args = array(
      'label'               => __( 'Portfolio', 'text_domain' ),
      'description'         => __( 'Add details of Portfolio items', 'text_domain' ),
      'labels'              => $labels,
      'supports'            => array( 'title', 'excerpt', 'editor', 'thumbnail', 'page-attributes', 'publicize', 'shortlinks' ),
      'hierarchical'        => false,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'menu_position'       => 13,
      'menu_icon'           => 'dashicons-portfolio',
      'show_in_admin_bar'   => true,
      'show_in_nav_menus'   => true,
      'can_export'          => true,
      'has_archive'         => true,    
      'exclude_from_search' => false,
      'publicly_queryable'  => true,
      'capability_type'     => 'page',
    );
    register_post_type( 'portfolio', $args );
    
    register_taxonomy(
      'portfolio_type',
      'portfolio',
      array(
        'label' => __( 'Portfolio Type' ),
        'rewrite' => array( 'slug' => 'portfolio_type' ),
        'hierarchical' => true,
      )
    );
  
}

// Hook into the 'init' action
add_action( 'init', 'gpwd_custom_post_type_init', 0 );