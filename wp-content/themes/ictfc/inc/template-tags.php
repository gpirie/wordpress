<?php

	defined( 'ABSPATH' ) or die( 'Nice try' );

	function ict_site_logo() {
		if ( has_custom_logo() ) 
		{
			the_custom_logo();
		}
		else 
		{
			$description = get_bloginfo( 'description', 'display' );
			$title = get_bloginfo( 'title', 'display' );

			if ( $title ) 
			{
				echo '<h1 class="site-title">'. $title .'</h1>';
			}
		}			
	}

	/* Add editor styles */
	function ict_add_editor_styles() {

		if( file_exists(  ICT_THEME_INC . 'assets/css/editor-style.css' ) ) {
	    	add_editor_style( ICT_THEME_INC . 'assets/css/editor-style.css' );
		}
	}
	add_action( 'admin_init', 'ict_add_editor_styles' );

	/* Customise logo output*/
	function ict_logo_class() {
	    $custom_logo_id = get_theme_mod( 'custom_logo' );

	    $html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
	            esc_url( home_url( '/' ) ),
	            wp_get_attachment_image( $custom_logo_id, 'full', false, array(
	                'class'    => 'site-logo',
	            ) )
	        );
	    return $html;   
	}
	add_filter( 'get_custom_logo', 'ict_logo_class' );


	/* Add meaningful class to menu items*/
	function ict_menu_class($classes, $item, $args) {

		/* Add generic class to all menu-items across the site*/
		$classes[] = 'c-navmenu__item c-navmenu__item--'. $args->theme_location;

		/* Add class to top-level items*/
		if ( $item->menu_item_parent == 0 ) 
		{
			$classes[] = 'c-navmenu__item--parent c-navmenu__item--parent--'. $args->theme_location;	
		}
		/* Add class to child-items*/
		else
		{
			$classes[] = 'c-navmenu__item--child c-navmenu__item--child--'. $args->theme_location;	
		}
    	return $classes;
	}
	add_filter('nav_menu_css_class' , 'ict_menu_class' , 10 , 3);

	/* Add class to menu links*/
	function add_specific_menu_location_atts( $atts, $item, $args ) {
		$atts['class'] = 'c-navmenu__link c-navmenu__link--'. esc_attr( $args->theme_location );
		return $atts;
	}
	add_filter( 'nav_menu_link_attributes', 'add_specific_menu_location_atts', 10, 3 );

	function ict_submenu_class($menu, $args) {  

		$menu = preg_replace( '/ class="sub-menu"/','class="c-navmenu__submenu c-navmenu__submenu--'. $args->theme_location .'"', $menu );

		return $menu;  
	}  
	add_filter('wp_nav_menu','ict_submenu_class', 10, 2);

	/* In-article adverts*/
	function ict_insert_post_ads( $content ) 
	{
		if ( true === get_theme_mod( 'in_article' ) ) 
		{
			$paragraph_number = get_theme_mod( 'in_article_number' ) ;

			if( false === empty( $paragraph_number ) ) {
				$ad_code = '<div class="o-advert o-advert--mpu alignleft" rel="advert" data-companion="yes" data-sizes="300x250" data-targeting="pos=article"></div>';

				if ( is_single() && ! is_admin() ) {
					return ict_insert_after_paragraph( $ad_code, $paragraph_number, $content );
				}
			}
		}
		
		return $content;
	}
	add_filter( 'the_content', 'ict_insert_post_ads' );

	function ict_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
		$closing_p = '</p>';
		$paragraphs = explode( $closing_p, $content );

		foreach ($paragraphs as $index => $paragraph) 
		{
			if ( trim( $paragraph ) ) {
				$paragraphs[$index] .= $closing_p;
			}

			if ( $paragraph_id == $index + 1 ) {
				$paragraphs[$index] .= $insertion;
			}
		}
		
		return implode( '', $paragraphs );
	}

	function ict_navigation( $theme_location, $menu_toggle = false ) 
	{
		if ( has_nav_menu( $theme_location ) ) 
		{ 
			if( $menu_toggle === true ) {
				echo '<a class="c-toggle c-toggle--'. $theme_location .' u-hidden@md u-hidden@lg u-hidden@print" href="#">Menu</a>';	
		    }

		    wp_nav_menu( array(
		        'theme_location' 	=> $theme_location,
		        'container'      	=> 'nav',
		        'container_class' 	=> 'c-navmenu c-navmenu--'. $theme_location .' u-hidden@print',
		        'menu_class'     	=> 'c-navmenu__menu c-navmenu__menu--'. $theme_location,
		        'items_wrap'     	=> '<ul class="%2$s">%3$s</ul>'
		    ));
		}
	}

	// Posts > Paragraph Count
	function ict_paragraph_count() {

	    $content = apply_filters('the_content', get_the_content());
	    $content = explode("</p>", $content);
	    $count = count($content);

	    return $count;
	}

	// Posts > Post length logic
	function ict_post_length( $classes ) {

	    $length = ict_paragraph_count();

	    $article_type = 'o-'. get_post_type();

	    if( false == get_post_type() ) {
	    	return;
	    }
	    else {

		    $classes[] = $article_type;

		    if ( $length <= 6 ) {
		        $classes[] = $article_type .'--short-form';
		    } elseif ( $length > 6 && $length <= 20 ) {
		        $classes[] = $article_type .'--medium-form';
		    } elseif ( $length > 20 ) {
		        $classes[] = $article_type .'--long-form';
		    }

		    return $classes;
		}
	}
	add_filter( 'post_class', 'ict_post_length' );

	function ict_post_thumbnail( $size = 'large' ) {

		if( has_post_thumbnail() )
		{
			global $post;
			
			//Thumbnail ID
			$thumbnail_id = ( get_post_thumbnail_id( $post->ID ) ) ? get_post_thumbnail_id( $post->ID ) : '';

			//Alt Attribute
			$alt = ( get_post_meta( $post->ID, '_wp_attachment_image_alt', true ) ) ? get_post_meta( $post->ID, '_wp_attachment_image_alt', true ) : 'Featured Image for '. trim( strip_tags( $post->post_title ) );

			//Title Attribute
			$title = ( get_the_title( $thumbnail_id ) ) ? get_the_title( $thumbnail_id ) : trim( strip_tags( $post->post_title ) ) .' Featured Image';

			//Image Meta
			$metadata = wp_get_attachment_metadata( $thumbnail_id );

			if( $metadata ) {
				$copyright = ( $metadata['image_meta']['copyright'] ) ? $metadata['image_meta']['copyright'] : '';
			}
			//Render image
			echo '<figure class="o-thumbnail u-relative">';

			the_post_thumbnail( $size , array( 'class' => 'o-thumbnail__image', 'itemprop' => 'image', 'alt' => $alt, 'title' => $title ) );
			
			if ( $caption )
			{
				echo '<figcaption class="o-thumbnail__caption u-relative">'. $caption .'</figcaption>';
			}

			if ( $copyright ) {
				echo '<small class="o-thumbnail__copyright">'. $copyright .'</small>';
			}

			echo '</figure>';
		}
	}

	function ict_get_the_categories() {
		$categories = get_the_category();
		if ( ! empty( $categories ) ) 
		{
			$output = '<ul class="o-categorylist">';

		    foreach( $categories as $category ) 
		    {
		        $output .= '<li class="o-categorylist__item"><a class="o-categorylist__link" href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_attr( $category->name ) . '</a></li>';
			}

			$output .= '</ul>';

		    echo $output;
		}
	}

	function ict_get_the_tags() {
		$posttags = get_the_tags();
		
		if ( $posttags ) 
		{
			$output = '<ul class="o-taglist">';

			foreach( $posttags as $tag ) 
			{
				$output .= '<li class="o-taglist__item"><a class="o-taglist__link" href="'. esc_url( get_category_link( $tag->term_id ) ) .'">'. esc_attr( $tag->name ) . '</a></li>'; 
			}

			$output .= '</ul>';

			echo $output;
		}
	}

	function ict_get_acf_field( $key ) {
		$value = get_field( $key );
		return ( false === empty( $value ) ) ? $value : '';
	}

	function ict_get_acf_sub_field( $key ) {
		$value = get_sub_field( $key );
		return ( false === empty( $value ) ) ? $value : '';
	}

	function my_post_gallery($output, $attr) {
	    global $post;

	    if (isset($attr['orderby'])) {
	        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
	        if (!$attr['orderby'])
	            unset($attr['orderby']);
	    }

	    extract(shortcode_atts(array(
	        'order' => 'ASC',
	        'orderby' => 'menu_order ID',
	        'id' => $post->ID,
	        'itemtag' => 'dl',
	        'icontag' => 'dt',
	        'captiontag' => 'dd',
	        'columns' => 3,
	        'size' => 'thumbnail',
	        'include' => '',
	        'exclude' => ''
	    ), $attr));

	    $id = intval($id);
	    if ('RAND' == $order) $orderby = 'none';

	    if (!empty($include)) {
	        $include = preg_replace('/[^0-9,]+/', '', $include);
	        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

	        $attachments = array();
	        foreach ($_attachments as $key => $val) {
	            $attachments[$val->ID] = $_attachments[$key];
	        }
	    }

	    if (empty($attachments)) return '';

	    // Here's your actual output, you may customize it to your need
	    $output = "<div class=\"slideshow-wrapper\">\n";
	    $output .= "<div class=\"preloader\"></div>\n";
	    $output .= "<ul data-orbit>\n";

	    // Now you loop through each attachment
	    foreach ($attachments as $id => $attachment) {
	        // Fetch the thumbnail (or full image, it's up to you)
	//      $img = wp_get_attachment_image_src($id, 'medium');
	//      $img = wp_get_attachment_image_src($id, 'my-custom-image-size');
	        $img = wp_get_attachment_image_src($id, 'full');

	        $output .= "<li>\n";
	        $output .= "<img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />\n";
	        $output .= "</li>\n";
	    }

	    $output .= "</ul>\n";
	    $output .= "</div>\n";

	    return $output;
	}

	// error, warning, success  or info
	function ict_display_notification($text, $type = 'error') {

		echo sprintf('

			<div class="o-notice o-notice--%s">
				<p class="o-notice__message">%s</p>
			</div>

		', $type, $text);
	}

	function ict_social_links() {
		$social_links = array();

		$social_links[] = get_theme_mods();

		if( false === empty( $social_links ) ) {

			$html = '<ul class="o-sociallinks u-overflow">';

			foreach ( $social_links[0] as $key => $value ) {
				$exp_key = explode( '_', $key );

				$network_name = $exp_key[1];
				
				if( $exp_key[0] === 'social' && false === empty( $value ) )
				{
					$html .= '<li class="o-sociallinks__item o-sociallinks__item--'. $network_name .'">';
					$html .= '<a target="_blank" class="o-sociallinks__link u-block" href="'. esc_url( $value ) .'" title="'. ucwords( $network_name ) .'">';
					$html .= '<img alt="" title="'. ucwords( $network_name ) .'" src="'. get_stylesheet_directory_uri() .'/assets/img/icons/'. $network_name .'.svg" />';
					$html .= '</a>';
					$html .= '</li>';
				}
			}

			$html .= '</ul>';
		}

		echo $html;
	}

	