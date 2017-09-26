<?php

	defined( 'ABSPATH' ) or die( 'Nice try' );

	function starter_site_logo() {
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
	function starter_add_editor_styles() {

		if( file_exists(  STARTER_THEME_INC . 'assets/css/editor-style.css' ) ) {
	    	add_editor_style( STARTER_THEME_INC . 'assets/css/editor-style.css' );
		}
	}
	add_action( 'admin_init', 'starter_add_editor_styles' );

	/* Customise logo output*/
	function starter_logo_class() {
	    $custom_logo_id = get_theme_mod( 'custom_logo' );

	    $html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
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
		$atts['class'] = 'c-navmenu__link c-navmenu__link--'. esc_attr( $args->theme_location );
		return $atts;
	}
	add_filter( 'nav_menu_link_attributes', 'add_specific_menu_location_atts', 10, 3 );

	function starter_submenu_class($menu, $args) {  

		$menu = preg_replace( '/ class="sub-menu"/','class="c-navmenu__submenu c-navmenu__submenu--'. $args->theme_location .'"', $menu );

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
				$ad_code = '<div class="o-advert o-advert--mpu alignleft" rel="advert" data-companion="yes" data-sizes="300x250" data-targeting="pos=article"></div>';

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

	function starter_navigation( $theme_location, $menu_toggle = false ) 
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
	function starter_paragraph_count() {

	    $content = apply_filters('the_content', get_the_content());
	    $content = explode("</p>", $content);
	    $count = count($content);

	    return $count;
	}

	// Posts > Post length logic
	function starter_post_length( $classes ) {

	    $length = starter_paragraph_count();

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
	add_filter( 'post_class', 'starter_post_length' );

	function starter_post_thumbnail( $size = 'large' ) {

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

			echo $output;
		}
	}

	function starter_get_acf_field( $key ) {
		$value = get_option( $key );
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
	function starter_display_notification($text, $type = 'error') {

		echo sprintf('

			<div class="o-notice o-notice--%s">
				<p class="o-notice__message">%s</p>
			</div>

		', $type, $text);
	}

	function starter_validate_telephone($telephone) {

		if(!empty($telephone)) {
			$regex = "/^(((\+44\s?\d{4}|\(?0\d{4}\)?)\s?\d{3}\s?\d{3})|((\+44\s?\d{3}|\(?0\d{3}\)?)\s?\d{3}\s?\d{4})|((\+44\s?\d{2}|\(?0\d{2}\)?)\s?\d{4}\s?\d{4}))(\s?\#(\d{4}|\d{3}))?$/";

			$telephone = str_replace(" ", "", $telephone);
			$telephone = trim($telephone);

			return (1 == preg_match($regex, $telephone)) ? true : false;
		}
		return false;
	}

	function starter_validate_postcode($uk_postcode) {

		if(!empty($uk_postcode)) {

			$regex = "/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([AZa-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z]))))[0-9][A-Za-z]{2})$/";

			$uk_postcode = str_replace(" ", "", $uk_postcode);
			$uk_postcode = trim($uk_postcode);

			return (1 == preg_match($regex, $uk_postcode)) ? true : false;
		}

		return false;
	}

	function starter_form_posted_back() {
		return !empty($_POST['form_post_nonce']);
	}

	function starter_custom_contact_form_display() {

		//Generate form markup
		$form = '
			<form class="o-form o-form--contactsupplier" action="'. get_permalink() .'" method="post">
				<label for="first-name">First Name</label>
				<input id="first-name" name="first_name" type="text" />

				<label for="last-name">Last Name</label>
				<input id="last-name" name="last_name" type="text" />

				<label for="email">Email Address</label>
				<input id="email" name="email" type="email" />

				<label for="wedding-date">Wedding Date</label>
				<input id="wedding-date" name="wedding_date" type="date" />

				<label for="phone-number">Phone Number</label>
				<input id="phone-number" name="phone_number" type="tel" />

				<label for="message">Message</label>
				<textarea id="message" name="message"></textarea>

				<input type="hidden" name="action" value="process_custom_contact_form">
				<input type="hidden" name="form_post_nonce" value="'. wp_create_nonce( 'starter_custom_contact_form_nonce' ) .'" />
				<input type="hidden" name="form_url" value="'. get_permalink() .'" />

				<input name="contact_supplier" type="submit" value="Submit" />

			</form>
		';

		return $form;
	}

	function starter_custom_contact_form_validate() {

		//response messages
		$missing_content = "Please supply all information.";
		$email_invalid   = "Email Address Invalid.";
		$message_unsent  = "Message was not sent. Try Again.";
		$message_sent    = "Thanks! Your message has been sent.";

		//user posted variables
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$wedding_date = $_POST['wedding_date'];
		$phone_number = $_POST['phone_number'];
		$message = $_POST['message'];
		$url = $_POST['form_url'];
		
		//Validation
		$validation_errors = array();

		//Email validation
		if( empty( $_POST['first-name'] ) ) {
			$validation_errors['first-name'] = 'Please enter your first name.';
		}

		if( isset( $_POST['email'] ) && !is_email( $_POST['email'] ) ) {
			$validation_errors['email'] = 'Please enter a valid email address.';
		}

		if( empty( $_POST['date_of_wedding'] ) ) {
			$validation_errors['date_of_wedding'] = 'Please enter a valid wedding date (in the format DD/MM/YYYY).';
		}

		return $validation_errors;

	}

	function starter_log($message, $additional_data = false, $type = 'error') {
		wpc_log_error($type, $message, $additional_data, 'vow-awards-errors');
	}

	function starter_custom_contact_form_thank_you() {
		return '
			<div class="o-notice o-notice--success">
				<p class="o-notice__message">Thank you for submitting a nomination to The Scottish VOWS Awards.</p>
			</div>';
	}

	function starter_custom_contact_form_process() {

		if( ! starter_form_posted_back() ) {
			va_log('No $_POST data');
			return false;
		}

		//php mailer variables
		$to = get_option( 'admin_email' );
		$subject = "Someone sent a message from ".get_bloginfo('name');
		$headers = 'From: '. $email . "\r\n" .
		'Reply-To: ' . $email . "\r\n";

		if( ! empty( $_POST ) ) 
		{
			$sent = wp_mail( $to, $subject, strip_tags( $message ), $headers );

			if( $sent ) {
				starter_display_notification( $message_sent, 'success' );
			}
			else {
				starter_display_notification( $message_unsent, 'error' );
			}
		}
		else
		{
			return $form;
		}
	}
	
	function starter_contact_form() {
		
		$html = '';
		$display_form = true;

		// Form submission? Validate and save?
		if( starter_form_posted_back() ) 
		{
			// Validate form!
			if( $errors = starter_custom_contact_form_validate() ) 
			{
				foreach( $errors as $error ) {
					$html .= starter_display_notification( $error, 'error' );
				}

			} 
			else 
			{
				// Save data
				$save_result = starter_custom_contact_form_process();

				if( $save_result ) 
				{
					$html .= va_nomination_form_thank_you();
					$display_form = false;
				} 
				else 
				{
					// Display error.
					$html .= starter_display_notification( 'general-error', 'error' );
				}
			}
		}

		// Do we need to display the form (first time page visit or validation error)?
		if($display_form) {
			$html .= starter_custom_contact_form_display();
		}

		return $html;
	}
	add_shortcode( 'contact_form', 'starter_contact_form' );