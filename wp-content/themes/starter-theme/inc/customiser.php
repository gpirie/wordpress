<?php
/**
 * Adding custom sections for social links, sharing and copyright notice to the customizer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Name
 */

defined( 'ABSPATH' ) || die( 'Nice try' );

/**
 * Adds social links, sharing and copyright notice to the customizer.
 *
 * @access   public
 * @since    1.0.0
 * @param  array $wp_customize The customizer array from WordPress.
 */
function starter_customiser( $wp_customize ) {
	// Social Media.
	$social_links = array();
	$social_links[] = array(
		'slug'	=> 'social_facebook_account',
		'label'	=> __( 'Facebook Page Link', 'starter-theme' ),
	);
	$social_links[] = array(
		'slug'	=> 'social_twitter_account',
		'label'	=> __( 'Twitter Page Link', 'starter-theme' ),
	);
	$social_links[] = array(
		'slug'	=> 'social_instagram_account',
		'label'	=> __( 'Instagram Page Link', 'starter-theme' ),
	);
	$social_links[] = array(
		'slug'	=> 'social_pinterest_account',
		'label'	=> __( 'Pinterest Page Link', 'starter-theme' ),
	);
	$social_links[] = array(
		'slug'	=> 'social_linkedin_account',
		'label'	=> __( 'Linked In Page Link', 'starter-theme' ),
	);
	$social_links[] = array(
		'slug'	=> 'social_googleplus_account',
		'label'	=> __( 'Google Plus Page Link', 'starter-theme' ),
	);
	$social_links[] = array(
		'slug'	=> 'social_youtube_account',
		'label'	=> __( 'YouTube Page Link', 'starter-theme' ),
	);

	$wp_customize->add_section( 'starter_theme_social' , array(
		'title'      => __( 'Social Media Accounts', 'starter-theme' ),
		'priority'   => 50,
	) );

	foreach ( $social_links as $link ) {
		// SETTINGS.
		$wp_customize->add_setting( $link['slug'] );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				$link['slug'],
				array(
					'label' => $link['label'],
					'section' => 'starter_theme_social',
					'settings' => $link['slug'],
					'type' => 'url',
				)
			)
		);
	}

	// Footer.
	$wp_customize->add_section( 'starter_theme_footer' , array(
		'title'      => __( 'Footer', 'starter-theme' ),
		'priority'   => 50,
	) );

	$wp_customize->add_setting( 'copyright', array(
		'default' => '',
	) );

	$wp_customize->add_control( 'copyright', array(
		'label' => 'Copyright',
		'section' => 'starter_theme_footer',
		'settings' => 'copyright',
		'type' => 'text',
	) );

	// Socialize Networks.
	$wp_customize->add_section( 'starter_theme_sharing' , array(
		'title'      => __( 'Social Sharing', 'starter-theme' ),
		'priority'   => 50,
	) );

	$sharing_links = array();
	$sharing_links[] = array(
		'slug'	=> 'share_email',
		'label'	=> __( 'Email', 'starter-theme' ),
	);
	$sharing_links[] = array(
		'slug'	=> 'share_facebook',
		'label'	=> __( 'Facebook', 'starter-theme' ),
	);
	$sharing_links[] = array(
		'slug'	=> 'share_twitter',
		'label'	=> __( 'Twitter', 'starter-theme' ),
	);
	$sharing_links[] = array(
		'slug'	=> 'share_messenger',
		'label'	=> __( 'Facebook Messenger', 'starter-theme' ),
	);
	$sharing_links[] = array(
		'slug'	=> 'share_google',
		'label'	=> __( 'Google +', 'starter-theme' ),
	);
	$sharing_links[] = array(
		'slug'	=> 'share_linkedin',
		'label'	=> __( 'Linked In', 'starter-theme' ),
	);
	$sharing_links[] = array(
		'slug'	=> 'share_reddit',
		'label'	=> __( 'Reddit', 'starter-theme' ),
	);
	$sharing_links[] = array(
		'slug'	=> 'share_tumblr',
		'label'	=> __( 'Tumblr', 'starter-theme' ),
	);
	$sharing_links[] = array(
		'slug'	=> 'share_whatsapp',
		'label'	=> __( 'WhatsApp', 'starter-theme' ),
	);
	$sharing_links[] = array(
		'slug'	=> 'share_vkontakte',
		'label'	=> __( 'VKontakte', 'starter-theme' ),
	);

	foreach ( $sharing_links as $link )	{
		$wp_customize->add_setting( $link['slug'] );
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				$link['slug'],
				array(
					'label' => $link['label'],
					'section' => 'starter_theme_sharing',
					'settings' => $link['slug'],
					'type' => 'checkbox',
				)
			)
		);
	}
}

add_action( 'customize_register', 'starter_customiser' );
