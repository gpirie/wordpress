<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Name
 */
?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<!--IE Edge -->
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

		<?php do_action( 'body_open' ); ?>
		
		<a class="skip-link screen-reader-text u-visuallyhidden" href="#content"><?php esc_html_e( 'Skip to content', 'starter-theme' ); ?></a>

		<header class="c-siteheader" itemscope itemtype="http://schema.org/WPHeader">				

			<?php
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

				if ( has_nav_menu( 'main_menu' ) ) 
				{
					wp_nav_menu( array( 'theme_location' => 'main_menu', 'container' => 'ul', 'menu_class' => 'c-navmenu u-hidden@print', 'container_id' => false ) );
				}

				starter_social_accounts();

			?>	

		</header>