<?php
	/* Add editor styles */
	function starter_add_editor_styles() {

		if( file_exists(  STARTER_THEME_INC . 'assets/css/editor-style.css' ) ) :
	    	add_editor_style( 'assets/css/editor-style.css' );
		endif;
	}
	add_action( 'admin_init', 'starter_add_editor_styles' );

	/* Customise logo output*/
	function starter_logo_class() {
	    $custom_logo_id = get_theme_mod( 'custom_logo' );

	    $html = sprintf( '<a href="%1$s" class="custom-logo-link u-block" rel="home" itemprop="url">%2$s</a>',
	            esc_url( home_url( '/' ) ),
	            wp_get_attachment_image( $custom_logo_id, 'full', false, array(
	                'class'    => 'site-logo',
	            ) )
	        );
	    return $html;   
	}
	add_filter( 'get_custom_logo', 'starter_logo_class' );


	/* Add meaningful class to menu items*/
	function starter_menu_class($classes, $item, $args) {

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
	add_filter('nav_menu_css_class' , 'starter_menu_class' , 10 , 3);

	/* Add class to menu links*/
	function add_specific_menu_location_atts( $atts, $item, $args ) {
		$atts['class'] = 'c-navmenu__link c-'. esc_attr( $args->theme_location ) .'__link"';
		return $atts;
	}
	add_filter( 'nav_menu_link_attributes', 'add_specific_menu_location_atts', 10, 3 );

	function starter_submenu_class($menu, $args) {  

		$menu = preg_replace( '/ class="sub-menu"/','/ class="c-navmenu__submenu c-navmenu__submenu--'. $args->theme_location .'" /',$menu );

		return $menu;  
	}  
	add_filter('wp_nav_menu','starter_submenu_class', 10, 2);

	/* In-article adverts*/
	function starter_insert_post_ads( $content ) 
	{
		if ( true === get_theme_mod( 'in_article' ) ) 
		{
			$paragraph_number = get_theme_mod( 'in_article_number' ) ;

			if( false === empty( $paragraph_number ) ) {
				$ad_code = '<div class="dfp-ad mpu alignleft" rel="advert" data-companion="yes" data-sizes="300x250" data-targeting="pos=article"></div>';

				if ( is_single() && ! is_admin() ) {
					return starter_insert_after_paragraph( $ad_code, $paragraph_number, $content );
				}

			}
		}
		
		return $content;
	}
	add_filter( 'the_content', 'starter_insert_post_ads' );

	function starter_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
		$closing_p = '</p>';
		$paragraphs = explode( $closing_p, $content );
		foreach ($paragraphs as $index => $paragraph) {

			if ( trim( $paragraph ) ) {
				$paragraphs[$index] .= $closing_p;
			}

			if ( $paragraph_id == $index + 1 ) {
				$paragraphs[$index] .= $insertion;
			}
		}
		
		return implode( '', $paragraphs );
	}

	function starter_navigation( $theme_location, $container_class, $menu_class, $menu_toggle ) {

		if ( has_nav_menu( $theme_location ) ) { 

			if( $menu_toggle === true ) {
				echo '<a class="c-toggle u-hidden@md u-hidden@lg u-hidden@print" href="#">Menu</a>';	
		    }

		    wp_nav_menu( array(
		        'theme_location' 	=> $theme_location,
		        'container'      	=> 'nav',
		        'container_class' 	=> $container_class .' u-hidden@print',
		        'menu_class'     	=> $menu_class,
		        'items_wrap'     	=> ($menu_toggle == true ? '<a class="c-navmenu__close c-toggle" href="#">Close</a>' : '') . '<ul class="%2$s">%3$s</ul>'
		    ));

		}
	}

	// Posts > Paragraph Count
	function starter_paragraph_count() {

	    $content = apply_filters('the_content', get_the_content());
	    $content = explode("</p>", $content);
	    $count = count($content);

	    return $count;
	}

	// Posts > Post length logic
	function starter_post_length( $classes ) {

	    $length = starter_paragraph_count();

	    if ( $length <= 6 ) {
	        $classes[] = 'o-post--short-form';
	    } elseif ( $length > 6 && $length <= 20 ) {
	        $classes[] = 'o-post--medium-form';
	    } elseif ( $length > 20 ) {
	        $classes[] = 'o-post--long-form';
	    }

	    return $classes;
	}
	add_filter( 'post_class', 'starter_post_length' );

	function starter_post_format_class( $classes ) {
		
		if( get_post_type() == 'post' ) {

			$format = get_post_format();

			$classes[] = 'o-post';

			if( false === empty( $format ) ) {
				$classes[] = 'o-post--'. $format;
			}
		}
		elseif( get_post_type() == 'page' ) {
			$classes[] = 'o-page';
		}
		else {

			$post_type = get_post_type();

			$classes[] = 'o-post--'. $post_type;
		}
		
		return $classes;
	}
	add_filter( 'post_class', 'starter_post_format_class' );

	function starter_post_thumbnail( $size = 'large' ) {

		if( has_post_thumbnail() )
		{
			echo '<figure class="o-thumbnail">';

			the_post_thumbnail( $size , array( 'class' => 'o-thumbnail__image', 'itemprop' => 'image' ) );
			
			if ( $caption )
			{
				echo '<figcaption class="o-thumbnail__caption u-relative">'. $caption .'</figcaption>';
			}

			echo '</figure>';
		}
	}

	function starter_get_the_categories() {
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

	function starter_get_the_tags() {
		$posttags = get_the_tags();
		if ( $posttags ) 
		{
			$output = '<ul class="o-taglist">';

			foreach( $posttags as $tag ) 
			{
				$output .= '<li class="o-taglist__item"><a class="o-taglist__link" href="'. esc_url( get_category_link( $tag->term_id ) ) .'">'. esc_attr( $tag->name ) . '</a></li>'; 
			}

			$output .= '</ul>';
		}

		echo $output;
	}

	function starter_gallery($html, $attr) {
		
		global $post;

		extract(shortcode_atts(array(
			'order'      => 'ASC',
			'id'         => $post->ID,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => 1,
			'size'       => 'full',
			'include'    => '',
			'exclude'    => ''
		), $attr));

		$id      = intval($id);
	    $orderby = 'post__in';

		$include = preg_replace('/[^0-9,]+/', '', $include);
		$_attachments = get_posts(array(
	        'include'        => $include,
	        'post_status'    => 'inherit',
	        'post_type'      => 'attachment',
	        'post_mime_type' => 'image',
	        'order'          => $order,
	        'orderby'        => $orderby
	    ));

		$attachments = array();

		foreach ($_attachments as $key => $val) 
		{
			$attachments[$val->ID] = $_attachments[$key];
		}

		if ( empty($attachments) === false ) 
	    {
	        $attach_count = count($attachments);

	        // Construct HTML
	        $html .= '<ul id="gallery-13" class="o-gallery galleryid-'. $post->ID .'">';

	        foreach ($attachments as $id => $attachment) 
	        {
	            $img = wp_get_attachment_image_src($id, 'medium');

	            if ( empty($img) === false ) 
	            {
	                $caption = $attachment->post_excerpt;

	                $html .= '<li class="o-gallery__item">';
	                $html .= $copyright;
	                $html .= '<figure class="o-gallery__figure">';
	                $html .= '<img class="o-gallery__img" alt="'. esc_attr( $caption ) . '" title="'. esc_attr( $caption ) . '" src="' . esc_html( $img[0] ) . '" />';

	                if( $caption ) {
	                	$html .= '<figcaption class="o-gallery__caption">'. esc_attr( $caption ) . '</figcaption>';
	                }
	                $html .= '</figure>';

	                $html .= '</li>';
	            }
	        }

	        $html .= '</ul>';

	        return $html;
	    }
	    else 
	    {
	        return '';
	    }   
	}
	add_filter('post_gallery', 'starter_gallery', 10, 2);