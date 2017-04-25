<?php
	/* Add editor styles */
	function ms_add_editor_styles() {
	    add_editor_style( 'assets/css/editor-style.css' );
	}
	add_action( 'admin_init', 'ms_add_editor_styles' );

	/* Customise logo output*/
	function ms_logo_class() {
	    $custom_logo_id = get_theme_mod( 'custom_logo' );

	    $html = sprintf( '<a href="%1$s" class="site-logo-link" rel="home" itemprop="url">%2$s</a>',
	            esc_url( home_url( '/' ) ),
	            wp_get_attachment_image( $custom_logo_id, 'full', false, array(
	                'class'    => 'site-logo',
	            ) )
	        );
	    return $html;   
	}
	add_filter( 'get_custom_logo', 'ms_logo_class' );


	/* Add meaningful class to menu items*/
	function ms_menu_class($classes, $item, $args) {

		/* Add generic class to all menu-items across the site*/
		$classes[] = 'c-menuitem c-menuitem--'. $args->theme_location;

		/* Add class to top-level items*/
		if ( $item->menu_item_parent == 0 ) 
		{
			$classes[] = 'c-menuitem--'. $args->theme_location . '__item--parent';	
		}
		/* Add class to child-items*/
		else
		{
			$classes[] = 'c-menuitem--'. $args->theme_location . '__item--child';	
		}
    	return $classes;
	}
	add_filter('nav_menu_css_class' , 'ms_menu_class' , 10 , 3);

	/* Add class to menu links*/
	function ms_add_menuclass($ulclass, $args) {
		return preg_replace('/<a /', '<a class="c-'. $args->theme_location .'__link"', $ulclass);
	}
	add_filter('wp_nav_menu','ms_add_menuclass', 10, 3);

	/* In-article adverts*/
	function ms_insert_post_ads( $content ) 
	{
		if ( true === get_theme_mod( 'in_article' ) && get_theme_mod( 'in_article_number' ) ) 
		{
			$paragraph_number = get_theme_mod( 'in_article_number' ) ;

			$ad_code = '<div class="dfp-ad mpu alignleft" rel="advert" data-companion="yes" data-sizes="300x250" data-targeting="pos=article"></div>';

			if ( is_single() && ! is_admin() ) {
				return ms_insert_after_paragraph( $ad_code, $paragraph_number, $content );
			}
		}
		
		return $content;
	}
	add_filter( 'the_content', 'ms_insert_post_ads' );

	function ms_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
		$closing_p = '</p>';
		$paragraphs = explode( $closing_p, $content );
		foreach ($paragraphs as $index => $paragraph) 
		{
			if ( trim( $paragraph ) ) 
			{
				$paragraphs[$index] .= $closing_p;
			}

			if ( $paragraph_id == $index + 1 ) 
			{
				$paragraphs[$index] .= $insertion;
			}
		}
		
		return implode( '', $paragraphs );
	}

	function ms_social_accounts() {
		$html = '<ul class="c-socialnetworks">';

		if( get_theme_mod( 'facebook_account' ) ) {
			$html .= '<li class="c-socialnetworks__item"><a class="c-socialnetworks--facebook" href="'. esc_url( get_theme_mod( 'facebook_account' ) ) .'">Facebook</a></li>';
		}
		if( get_theme_mod( 'twitter_account' ) ) {
			$html .= '<li class="c-socialnetworks__item"><a class="c-socialnetworks--twitter" href="'. esc_url( get_theme_mod( 'twitter_account' ) ) .'">Twitter</a></li>';
		}
		if( get_theme_mod( 'instagram_account' ) ) {
			$html .= '<li class="c-socialnetworks__item"><a class="c-socialnetworks--instagram" href="'. esc_url( get_theme_mod( 'instagram_account' ) ) .'">Instagram</a></li>';
		}

		$html .= '</ul>';

		echo $html;
	}