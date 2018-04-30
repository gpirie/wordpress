<?php
/**
 * Various functions which provide site functiality.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Name
 */

defined( 'ABSPATH' ) || die( 'Nice try' );

/**
 * Outputs the site logo if one has been added to the customizer. Falls back to site title if not.
 */
function starter_site_logo() {
	if ( has_custom_logo() ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		echo '<a class="site-logo" href="' . esc_url( get_home_url() ) . '"><img src="' . esc_url( $image[0] ) . '" alt="" title="" /></a>';
	} else {
		$description = get_bloginfo( 'description', 'display' );
		$title = get_bloginfo( 'title', 'display' );

		if ( $title ) {
			echo '<a class="site-logo" href="' . esc_url( get_home_url() ) . '"><h1 class="site-title">' . esc_html( $title ) . '</h1></a>';
		}
	}
}

/**
 * Adds a custom stylesheet to the editor. To be used to match fonts and content width for reference.
 *
 * @access   public
 * @since    1.0.0
 */
function starter_add_editor_styles() {

	if ( file_exists( STARTER_THEME_INC . 'assets/css/editor-style.css' ) ) {
		add_editor_style( STARTER_THEME_INC . 'assets/css/editor-style.css' );
	}
}
add_action( 'admin_init', 'starter_add_editor_styles' );

/**
 * Adds a css class to the site logo added in customizer.
 *
 * @access   public
 * @since    1.0.0
 */
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

/**
 * Add meaningful class to menu items.
 *
 * @access   public
 * @since    1.0.0
 * @param array $classes The classes that WP adds to menu items.
 * @param array $item The menu item.
 * @param array $args The arguments applied to each menu item.
 */
function starter_menu_class( $classes, $item, $args ) {

	/* Add generic class to all menu-items across the site*/
	$classes[] = 'c-navmenu__item c-navmenu__item--' . $args->theme_location;

	/* Add class to top-level items*/
	if ( 0 === $item->menu_item_parent ) {
		$classes[] = 'c-navmenu__item--parent c-navmenu__item--parent--' . $args->theme_location;
	}
	return $classes;
}
add_filter( 'nav_menu_css_class' , 'starter_menu_class' , 10 , 3 );

/**
 * Add class to menu links
 *
 * @access   public
 * @since    1.0.0
 * @param array $atts The attributes that WP adds to menu links.
 * @param array $item The menu item.
 * @param array $args The arguments applied to each menu item.
 * @return array
 */
function add_specific_menu_location_atts( $atts, $item, $args ) {
	$atts['class'] = 'c-navmenu__link c-navmenu__link--' . esc_attr( $args->theme_location );
	return $atts;
}
// add_filter( 'nav_menu_link_attributes', 'add_specific_menu_location_atts', 10, 3 );

/**
 * Add class to submenu links
 *
 * @access   public
 * @since    1.0.0
 * @param array $menu The menu which contains the submenu.
 * @param array $args The arguments applied to each menu item.
 * @return array
 */
function starter_submenu_class( $menu, $args ) {

	$menu = preg_replace( '/ class="sub-menu"/','class="c-navmenu__submenu c-navmenu__submenu--' . $args->theme_location . '"', $menu );

	return $menu;
}
// add_filter( 'wp_nav_menu','starter_submenu_class', 10, 2 );

/**
 * Adds adverts within articles
 *
 * @access   public
 * @since    1.0.0
 * @param array $content The post content.
 * @return string
 */
function starter_insert_post_ads( $content ) {
	if ( true === get_theme_mod( 'in_article' ) ) {
		$paragraph_number = get_theme_mod( 'in_article_number' );

		if ( false === empty( $paragraph_number ) ) {
			$ad_code = '<div class="o-advert o-advert--mpu alignleft" rel="advert" data-companion="yes" data-sizes="300x250" data-targeting="pos=article"></div>';

			if ( is_single() && ! is_admin() ) {
				return starter_insert_after_paragraph( $ad_code, $paragraph_number, $content );
			}
		}
	}

	return $content;
}
add_filter( 'the_content', 'starter_insert_post_ads' );

/**
 * Adds adverts within articles
 *
 * @access   public
 * @since    1.0.0
 * @param array $insertion The element to insert.
 * @param array $paragraph_id The paragraph which precedes the $insertion.
 * @param array $content The post content.
 * @return string
 */
function starter_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
	$closing_p = '</p>';
	$paragraphs = explode( $closing_p, $content );

	foreach ( $paragraphs as $index => $paragraph )	{
		if ( trim( $paragraph ) ) {
			$paragraphs[ $index ] .= $closing_p;
		}

		if ( $paragraph_id === $index + 1 ) {
			$paragraphs[ $index ] .= $insertion;
		}
	}

	return implode( '', $paragraphs );
}

/**
 * Function which allows for insertion of menus within the theme
 *
 * @access   public
 * @since    1.0.0
 * @param array $theme_location The location of the theme.
 * @param bool  $menu_toggle Boolean which determines if this menu should display a hamburger icon at small screen sizes.
 */
function starter_navigation( $theme_location, $menu_toggle = false ) {
	if ( has_nav_menu( $theme_location ) ) {
		if ( true === $menu_toggle ) {
			$menu_id = 'c-toggle--target';
			echo '<a class="c-toggle c-toggle--' . esc_attr( $theme_location ) . ' u-block u-hidden@md u-hidden@lg u-hidden@print" href="#'. esc_attr( $menu_id ) .'"></a>';
		}

		wp_nav_menu( array(
			'theme_location' 	=> esc_attr( $theme_location ),
			'container'      	=> 'nav',
			'container_class' 	=> 'c-navmenu c-navmenu--' . esc_attr( $theme_location ) . ' u-hidden@print',
			'container_id'		=> esc_attr( $menu_id ),
			'menu_class'     	=> 'c-navmenu__menu c-navmenu__menu--' . esc_attr( $theme_location ),
			'items_wrap'     	=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
		));
	}
}


/**
 * Counts the number of paragraphs within the content.
 *
 * @access   public
 * @since    1.0.0
 * @return int
 */
function starter_paragraph_count() {

	$content = apply_filters( 'the_content', get_the_content() );
	$content = explode( '</p>', $content );
	$count = count( $content );

	return $count;
}

/**
 * Adds conditional class dependant on the length of the post.
 *
 * @access   public
 * @since    1.0.0
 * @param array $classes The classes added to the content.
 * @return array
 */
function starter_post_length( $classes ) {

	$length = starter_paragraph_count();

	$article_type = 'o-' . get_post_type();

	if ( false === get_post_type() ) {
		return;
	} else {
		$classes[] = $article_type;

		if ( $length <= 6 ) {
			$classes[] = $article_type . '--short-form';
		} elseif ( $length > 6 && $length <= 20 ) {
			$classes[] = $article_type . '--medium-form';
		} elseif ( $length > 20 ) {
			$classes[] = $article_type . '--long-form';
		}

		return $classes;
	}
}
add_filter( 'post_class', 'starter_post_length' );

/**
 * Outputs the featured image of the post
 *
 * @access   public
 * @since    1.0.0
 * @param array $size The image size to display.
 */
function starter_post_thumbnail( $size = 'large' ) {

	if ( has_post_thumbnail() )	{
		global $post;

		// Thumbnail ID.
		$thumbnail_id = ( get_post_thumbnail_id( $post->ID ) ) ? get_post_thumbnail_id( $post->ID ) : '';

		// Alt Attribute.
		$alt = ( get_post_meta( $post->ID, '_wp_attachment_image_alt', true ) ) ? get_post_meta( $post->ID, '_wp_attachment_image_alt', true ) : 'Featured Image for ' . trim( strip_tags( $post->post_title ) );

		// Title Attribute.
		$title = ( get_the_title( $thumbnail_id ) ) ? get_the_title( $thumbnail_id ) : trim( strip_tags( $post->post_title ) ) . ' Featured Image';

		// Image Meta.
		$metadata = wp_get_attachment_metadata( $thumbnail_id );

		if ( $metadata ) {
			$copyright = ( $metadata['image_meta']['copyright'] ) ? $metadata['image_meta']['copyright'] : '';
		}
		// Render image.
		echo '<figure class="o-thumbnail u-relative">';

		the_post_thumbnail( $size , array(
			'class' => 'o-thumbnail__image',
			'itemprop' => 'image',
			'alt' => $alt,
			'title' => $title,
		) );

		if ( $caption )	{
			echo '<figcaption class="o-thumbnail__caption u-relative">' . esc_html( $caption ) . '</figcaption>';
		}

		if ( $copyright ) {
			echo '<small class="o-thumbnail__copyright">' . esc_html( $copyright ) . '</small>';
		}

		echo '</figure>';
	} // End if().
}

/**
 * Displays a list of categories that belong to a post.
 *
 * @access   public
 * @since    1.0.0
 */
function starter_get_the_categories() {
	$categories = get_the_category();
	if ( false === empty( $categories ) ) {
		$output = '<ul class="o-categorylist">';

		foreach ( $categories as $category ) {
			$output .= '<li class="o-categorylist__item"><a class="o-categorylist__link" href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_attr( $category->name ) . '</a></li>';
		}

		$output .= '</ul>';

		echo esc_html( $output );
	}
}

/**
 * Displays a list of tags that belong to a post.
 *
 * @access   public
 * @since    1.0.0
 */
function starter_get_the_tags() {
	$posttags = get_the_tags();

	$output = array();

	if ( false === empty( $posttags ) )	{
		$output = '<ul class="o-taglist">';

		foreach ( $posttags as $tag ) {
			$output .= '<li class="o-taglist__item"><a class="o-taglist__link" href="' . esc_url( get_category_link( $tag->term_id ) ) . '">' . esc_attr( $tag->name ) . '</a></li>';
		}

		$output .= '</ul>';

		echo( esc_html( $output ) );
	} else {
		return;
	}
}

/**
 * Wrapper function for displaying fields from acf. Checks for value before rendering the field.
 *
 * @access   public
 * @since    1.0.0
 * @param 	string $key The name of the field.
 */
function starter_get_acf_field( $key ) {
	$value = get_field( $key );
	return ( false === empty( $value ) ) ? $value : '';
}
/**
 * Wrapper function for displaying sub fields from acf. Checks for value before rendering the field.
 *
 * @access   public
 * @since    1.0.0
 * @param 	string $key The name of the field.
 */
function starter_get_acf_sub_field( $key ) {
	$value = get_sub_field( $key );
	return ( false === empty( $value ) ) ? $value : '';
}

/**
 * Custom markup for the default WordPress gallery.
 *
 * @access   public
 * @since    1.0.0
 * @param 	array $output The markup generated for the gallery.
 * @param 	array $attr The attributes applied to the gallery.
 * @return array
 */
function my_post_gallery( $output, $attr ) {
	global $post;

	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( ! $attr['orderby'] ) {
			unset( $attr['orderby'] );
		}
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
		'exclude' => '',
	), $attr));

	$id = intval( $id );
	if ( 'RAND' === $order ) {
		$orderby = 'none';
	}

	if ( ! empty( $include ) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts(array(
			'include' => $include,
			'post_status' => 'inherit',
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'order' => $order,
			'orderby' => $orderby,
		));

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[ $val->ID ] = $_attachments[ $key ];
		}
	}

	if ( empty( $attachments ) ) {
		return '';
	} else {

		// Here's your actual output, you may customize it to your need.
		$output = "<div class=\"slideshow-wrapper\">\n";
		$output .= "<div class=\"preloader\"></div>\n";
		$output .= "<ul data-orbit>\n";

		// Now you loop through each attachment.
		foreach ( $attachments as $id => $attachment ) {
			$img = wp_get_attachment_image_src( $id, 'full' );

			$output .= "<li>\n";
			$output .= "<img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />\n";
			$output .= "</li>\n";
		}

		$output .= "</ul>\n";
		$output .= "</div>\n";

		return $output;
	}
}

/**
 * Displays user notifications.
 *
 * @access   public
 * @since    1.0.0
 * @param 	string $text The text for the notification.
 * @param 	string $type The type of notification - error, warning, success or info.
 */
function starter_display_notification( $text, $type = 'error' ) {

	echo sprintf('
		<div class="o-notice o-notice--%s">
			<p class="o-notice__message">%s</p>
		</div>
	', esc_html( $type ), esc_html( $text )
	);
}
/**
 * Displays social media profile links based on what has been chosen in the customizer.
 *
 * @access   public
 * @since    1.0.0
 * @param 	string $class Takes the name of the network and added to the menu for styling purposes.
 */
function starter_social_links( $class = '' ) {
	$social_links = array();

	$social_links[] = get_theme_mods();

	if ( false === empty( $social_links ) ) {

		?>
			<ul class="o-sociallinks u-overflow <?php esc_attr( $class );?>">
		<?php

		foreach ( $social_links[0] as $key => $value ) {
			$exp_key = explode( '_', $key );

			$network_name = $exp_key[1];

			if ( 'social' === $exp_key[0] && false === empty( $value ) ) {
				?>
				<li class="o-sociallinks__item o-sociallinks__item--<?php esc_attr( $network_name );?>">
					<a target="_blank" class="o-sociallinks__link u-block" href="<?php esc_url( $value );?>" title="<?php esc_attr( ucwords( $network_name ) );?>">
						<img alt="" title="' . ucwords( $network_name ) . '" src="<?php get_stylesheet_directory_uri();?>/assets/img/icons/<?php esc_attr( $network_name );?>.svg" />
					</a>
				</li>
				<?php
			}
		}
		?>
		</ul>
		<?php
	}
}

/**
 * Displays social sharing links based on what is entered in the customizer.
 *
 * @access   public
 * @since    1.0.0
 * @return array
 */
function starter_get_socialize_networks() {
	$defined_networks = array();

	if ( get_theme_mod( 'share_facebook' ) ) {

		$defined_networks['facebook'] = array(
			'name' => 'Facebook',
			'mobile_only' => false,
		);
	}

	if ( get_theme_mod( 'share_twitter' ) ) {

		$defined_networks['twitter'] = array(
			'name' => 'Twitter',
			'mobile_only' => false,
		);
	}

	if ( get_theme_mod( 'share_messenger' ) ) {

		$defined_networks['fb-messenger'] = array(
			'name' => 'FB-Messenger',
			'mobile_only' => true,
		);
	}

	if ( get_theme_mod( 'share_google' ) ) {

		$defined_networks['googleplus'] = array(
			'name' => 'Google Plus',
			'mobile_only' => false,
		);
	}

	if ( get_theme_mod( 'share_linkedin' ) ) {

		$defined_networks['linkedin'] = array(
			'name' => 'Linked In',
			'mobile_only' => false,
		);
	}

	if ( get_theme_mod( 'share_reddit' ) ) {

		$defined_networks['reddit'] = array(
			'name' => 'Reddit',
			'mobile_only' => false,
		);
	}

	if ( get_theme_mod( 'share_tumblr' ) ) {

		$defined_networks['tumblr'] = array(
			'name' => 'Tumblr',
			'mobile_only' => false,
		);
	}

	if ( get_theme_mod( 'share_whatsapp' ) ) {

		$defined_networks['whatsapp'] = array(
			'name' => 'Whats App',
			'mobile_only' => true,
		);
	}

	if ( get_theme_mod( 'share_vkontakte' ) ) {

		$defined_networks['vkontakte'] = array(
			'name' => 'Vkontakte',
			'mobile_only' => false,
		);
	}

	if ( get_theme_mod( 'share_email' ) ) {

		$defined_networks['email'] = array(
			'name' => 'Email',
			'mobile_only' => false,
		);
	}
	return $defined_networks;
}
/**
 * Generates the url to share.
 *
 * @access   public
 * @since    1.0.0
 * @param 	int    $post_id The ID of the current post.
 * @param 	string $network The name of the social network.
 */
function starter_get_socialize_url( $post_id = null, $network = '' ) {
	$post_id = ( null === $post_id ? get_the_ID() : $post_id );

	/** Ensure that the network provided is actually supported by Socialize. */
	if ( false === array_key_exists( $network, starter_get_socialize_networks() ) ) {
		return '';
	}

	/**
	 * Make sure we have a Post ID and a Network to play with. Otherwise, return
	 * blank.
	 */
	if ( false === empty( $post_id ) && false === empty( $network ) ) {
		return add_query_arg( array(
			'share' => $network,
		), get_permalink() );
	}

	return '';
}
/**
 * Displays a list of networks to share the content with.
 *
 * @access   public
 * @since    1.0.0
 */
function starter_socialize_sharing_bar() {

	$networks = apply_filters( 'socialize_buttons_networks', starter_get_socialize_networks() );

	if ( false === empty( $networks ) ) {
		// Construct HTML.
		$html = '<ul class="c-socialsharing socialize overflow relative">';
		foreach ( $networks as $network => $network_details ) {
			$network_formatted = $network_details['name'];
			$networkname = str_replace( ' ', '', strtolower( $network_details['name'] ) );
			$html .= sprintf( '<li class="c-socialsharing__item socialize-%1$s socialize-icons no-text">
				<a class="c-socialsharing__link socialize-link" rel="nofollow" href="%2$s" title="Click here to share on %3$s">
				<span class="socialize-screen-reader-text">Click here to share on %3$s</span></a></li>',
				$networkname,
				starter_get_socialize_url( null, $networkname ),
				$network_formatted
			);
		}
		$html .= '</ul>';

		echo( esc_html( $html ) );
	}
}
/**
 * Displays post date and author information.
 *
 * @access   public
 * @since    1.0.0
 */
function starter_post_meta() {
	$post_meta = 'Posted ' . esc_html( human_time_diff( get_the_time( 'U' ) ), current_time( 'timestamp' ) ) . ' ago by <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>';
	echo '<div class="o-post__meta"><p>' . esc_html( $post_meta ) . '</p></div>';
}
