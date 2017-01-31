<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MotoScene Theme
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
		
		<a class="skip-link screen-reader-text u-visuallyhidden" href="#content"><?php esc_html_e( 'Skip to content', 'ms-theme' ); ?></a>

		<div class="wrap">

			<div class="leaderboard leaderboard--desktop u-hidden@print u-hidden@sm u-hidden@md u-centre-text">
				<div class="dfp-ad" rel="advert" pos="top" data-companion="yes" data-sizes="970x250,728x90"></div>
			</div>

			<div class="leaderboard leaderboard--tablet u-hidden@print u-hidden@sm u-hidden@lg u-centre-text">
				<div class="dfp-ad" rel="advert" pos="top" data-companion="yes" data-sizes="728x90"></div>
			</div>

			<div class="leaderboard leaderboard--mobile u-hidden@print u-hidden@md u-hidden@lg u-centre-text">
				<div class="dfp-ad" rel="advert" pos="top" data-companion="yes" data-sizes="300x250"></div>
			</div>

			<header itemscope itemtype="http://schema.org/WPHeader" role="banner">				

				<?php

					if ( has_custom_logo() ) :

						echo get_custom_logo();

					else :

						$description = get_bloginfo( 'description', 'display' );
						$title = get_bloginfo( 'title', 'display' );

						if ( $title || is_customize_preview() ) :

							echo '<p class="site-title">'. $title .'</p>';

						endif;

					endif;
				?>

			</header>