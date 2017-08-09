<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GP Web Design Theme
 */
?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

		<?php do_action( 'body_open' ); ?>
		
		<a class="skip-link screen-reader-text u-visuallyhidden" href="#content"><?php esc_html_e( 'Skip to content', 'gpwd-theme' ); ?></a>

		<header class="u-overflow" itemscope itemtype="http://schema.org/WPHeader">				

			<?php

				if ( has_custom_logo() ) :

					echo '<a class="u-block site-logo u-aligncenter u-centre-text" href="'. get_home_url() .'" title="'. get_bloginfo() .'" />';
					echo '<img src="'. gpwd_logo() .'" alt="'. get_bloginfo() .' logo" title="'. get_bloginfo() .'" />';
					echo '</a>';

				else :

					$description = get_bloginfo( 'description', 'display' );
					$title = get_bloginfo( 'title', 'display' );

					if ( $title || is_customize_preview() ) :

						echo '<p class="site-title">'. $title .'</p>';

					endif;

				endif;
			
				if ( has_nav_menu( 'main_menu' ) ) :
					echo '<a class="o-navtoggle o-navtoggle--main_menu u-block u-centre-text" href="#">Menu</a>';
					wp_nav_menu( array( 'container'=> 'nav', 'container_class' => 'c-main_menu overflow', 'theme_location' => 'main_menu', 'menu_class' => '' ) );
				
				endif;

			?>

		</header>