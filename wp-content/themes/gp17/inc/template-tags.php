<?php
	/* Add editor styles */
	function gpwd_add_editor_styles() {

		if( file_exists(  GPWD_THEME_INC . 'assets/css/editor-style.css' ) ) :
	    	add_editor_style( 'assets/css/editor-style.css' );
		endif;
	}
	add_action( 'admin_init', 'gpwd_add_editor_styles' );

	/* Customise logo output*/
	function gpwd_logo_class() {
	    $custom_logo_id = get_theme_mod( 'custom_logo' );

	    $html = sprintf( '<a href="%1$s" class="custom-logo-link u-block" rel="home" itemprop="url">%2$s</a>',
	            esc_url( home_url( '/' ) ),
	            wp_get_attachment_image( $custom_logo_id, 'full', false, array(
	                'class'    => 'site-logo u-centre u-block',
	            ) )
	        );
	    return $html;   
	}
	add_filter( 'get_custom_logo', 'gpwd_logo_class' );

	function gpwd_get_site_logo() {
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


	/* Add meaningful class to menu items*/
	function gpwd_menu_class($classes, $item, $args) {

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
	add_filter('nav_menu_css_class' , 'gpwd_menu_class' , 10 , 3);

	/* Add class to menu links*/
	function add_specific_menu_location_atts( $atts, $item, $args ) {
		$atts['class'] = 'c-navmenu__link c-navmenu__link--'. esc_attr( $args->theme_location );
		return $atts;
	}
	add_filter( 'nav_menu_link_attributes', 'add_specific_menu_location_atts', 10, 3 );

	function gpwd_submenu_class($menu, $args) {  

		$menu = preg_replace( '/ class="sub-menu"/','/ class="c-navmenu__submenu c-navmenu__submenu--'. $args->theme_location .'" /',$menu );

		return $menu;  
	}  
	add_filter('wp_nav_menu','gpwd_submenu_class', 10, 2);

	/* In-article adverts*/
	function gpwd_insert_post_ads( $content ) 
	{
		if ( true === get_theme_mod( 'in_article' ) ) 
		{
			$paragraph_number = get_theme_mod( 'in_article_number' ) ;

			if( false === empty( $paragraph_number ) ) {
				$ad_code = '<div class="dfp-ad mpu alignleft" rel="advert" data-companion="yes" data-sizes="300x250" data-targeting="pos=article"></div>';

				if ( is_single() && ! is_admin() ) {
					return gpwd_insert_after_paragraph( $ad_code, $paragraph_number, $content );
				}

			}
		}
		
		return $content;
	}
	add_filter( 'the_content', 'gpwd_insert_post_ads' );

	function gpwd_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
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

	function gpwd_navigation( $theme_location, $menu_toggle = false ) {

		if ( has_nav_menu( $theme_location ) ) { 

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
	function gpwd_paragraph_count() {

	    $content = apply_filters('the_content', get_the_content());
	    $content = explode("</p>", $content);
	    $count = count($content);

	    return $count;
	}

	// Posts > Post length logic
	function gpwd_post_length( $classes ) {

	    $length = gpwd_paragraph_count();

	    if ( $length <= 6 ) {
	        $classes[] = 'o-post--short-form';
	    } elseif ( $length > 6 && $length <= 20 ) {
	        $classes[] = 'o-post--medium-form';
	    } elseif ( $length > 20 ) {
	        $classes[] = 'o-post--long-form';
	    }

	    return $classes;
	}
	add_filter( 'post_class', 'gpwd_post_length' );

	function gpwd_post_format_class( $classes ) {
		
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

			$classes[] = 'o-post o-post--'. $post_type;
		}
		
		return $classes;
	}
	add_filter( 'post_class', 'gpwd_post_format_class' );

	function gpwd_post_thumbnail( $size = 'large' ) {

		if( has_post_thumbnail() )
		{
			echo '<figure class="o-thumbnail o-'. get_post_type() .'__thumbnail">';

			the_post_thumbnail( $size , array( 'class' => 'o-thumbnail__image', 'itemprop' => 'image' ) );
			
			if ( $caption )
			{
				echo '<figcaption class="o-thumbnail__caption u-relative">'. $caption .'</figcaption>';
			}

			echo '</figure>';
		}
	}

	function gpwd_get_the_categories() {
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

	function gpwd_get_the_tags() {
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

	function gpwd_gallery($html, $attr) {
		
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
	add_filter('post_gallery', 'gpwd_gallery', 10, 2);

	function gpwd_contact_details() {

		$gpwd_email = get_theme_mod( 'contact_email' );
		$gpwd_phone_number = get_theme_mod( 'contact_phone_number' );

		if( $gpwd_email || $gpwd_phone_number ) {

			echo '<ul class="o-contact">';

			if( get_theme_mod( 'contact_email' ) ) {
				printf( '<li class="o-contact__detail o-contact__detail--email"><a class="o-contact__link o-contact__link--email" href="mailto:%1$s">%1$s</a></li>', $gpwd_email );
			}

			if( get_theme_mod( 'contact_phone_number' ) ) {
				printf( '<li class="o-contact__detail o-contact__detail--phone"><a class="o-contact__link o-contact__link--phone" href="tel:%1$s">%1$s</a></li>', $gpwd_phone_number );
			}

			echo '</ul>';
		}
	}

	function gpwd_get_the_custom_logo( $theme_location ) {
		if( get_theme_mod( 'custom_logo' ) ) {
			$image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' );
			
			echo '<a href="'. get_home_url() .'" class="o-logo o-logo--'. $theme_location .'" itemprop="url" rel="home"><img class="o-logo__img o-logo__img--'. $theme_location .'" src="'. $image[0] .'" alt="" title=""></a>';
		}
	}

	function gpwd_get_portfolio() {
		$args = array(
			'post_type' => 'portfolio',
			'posts_per_page' => -1
		);

		$the_query = new WP_Query( $args );
		update_post_thumbnail_cache();

		// The Loop
		if ( $the_query->have_posts() ) 
		{
			echo '<ul class="o-porfolio">';
			while ( $the_query->have_posts() ) 
			{
				$the_query->the_post();

				?>
					<li class="o-portfolio__item o-portfolio__item--page u-overflow">
						<a class="o-portfolio__thumb" href="<?php the_permalink();?>" title="">
							<?php gpwd_post_thumbnail( 'large' );?>
						</a>

						<section class="o-portfolio__description">
							<h2 class="o-portfolio__title"><?php esc_attr_e( get_the_title() );?></h2>

							<?php the_excerpt();?>

							<a class="o-button o-button--portfolio" href="<?php the_permalink();?>">
								Read More
							</a>
						</section>
					</li>
				<?php

			}
			echo '</ul>';
			/* Restore original Post Data */
			wp_reset_postdata();
		} 
		else {
			// no posts found
		}
	}

	function gpwd_wpcf7_class_attr( $class ) {
	  $class .= ' o-form';
	  return $class;
	}
	add_filter( 'wpcf7_form_class_attr', 'gpwd_wpcf7_class_attr' );

	function gpwd_get_snippets() {
		$args = array(
			'post_type' => 'snippets'
		);

		$the_query = new WP_Query( $args );
		update_post_thumbnail_cache();

		// The Loop
		if ( $the_query->have_posts() ) 
		{
			echo '<ul class="o-snippets">';
			while ( $the_query->have_posts() ) 
			{
				$the_query->the_post();

				?>
					<li class="o-snippets__item o-snippets__item--page u-overflow">
						
						<h2 class="o-snippets__title"><?php esc_attr_e( get_the_title() );?></h2>

						<?php
							$snippet_language = ( get_field( 'language' ) ) ? get_field( 'language' ) : '';
						?>

						<pre class="o-snippets__code">
							<code class="language-<?php esc_attr_e( $snippet_language );?>">
								<?php echo htmlentities( get_field( 'code_block' ) );?>
							</code>
						</pre>

						<section class="o-snippets__description">
							
							<?php the_content();?>

						</section>
					</li>
				<?php
			}
			echo '</ul>';
			/* Restore original Post Data */
			wp_reset_postdata();
		}
	}

	function gpwd_get_acf_field( $key ) {
		$value = get_field( $key );
		return ( false === empty( $value ) ) ? $value : '';
	}

	function gpwd_get_acf_sub_field( $key ) {
		$value = get_sub_field( $key );
		return ( false === empty( $value ) ) ? $value : '';
	}