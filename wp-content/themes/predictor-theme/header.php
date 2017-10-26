<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Predictor Theme
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
		
		<div class="u-wrap">

			<a class="screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'fp-theme' ); ?></a>

			<header class="site-header" itemscope itemtype="http://schema.org/WPHeader">				

				<?php

					fp_navigation( 'header_menu' );

					fp_site_logo();

					fp_social_links();

					fp_navigation( 'main_menu', true );
					
				?>	

			</header>