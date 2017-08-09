<?php
	function starter_customiser( $wp_customize )
	{
		//Advertising Section
		$wp_customize->add_section( 'starter_theme_advertising' , array(
			'title'      => __( 'Advertising', 'starter-theme' ),
			'priority'   => 50,
		) );

		//DFP Network
		$wp_customize->add_setting( 'dfp_network', array(
			'default' => '',
		) );

		$wp_customize->add_control( 'dfp_network', array(
			'label' => 'DFP Network',
			'section' => 'starter_theme_advertising',
			'settings' => 'dfp_network',
			'type' => 'text',
		) );

		//Zepto
		$wp_customize->add_setting( 'zepto', array(
			'default' => false,
		) );

		$wp_customize->add_control( 'zepto', array(
			'label' => 'Add Zepto Support?',
			'section' => 'starter_theme_advertising',
			'settings' => 'zepto',
			'type' => 'checkbox',
		) );

		//Show leaderboard?
		$wp_customize->add_setting( 'leaderboard', array(
			'default' => true,
		) );

		$wp_customize->add_control( 'leaderboard', array(
			'label' => 'Display Leaderboard',
			'section' => 'starter_theme_advertising',
			'settings' => 'leaderboard',
			'type' => 'checkbox',
		) );

		//In article ads?
		$wp_customize->add_setting( 'in_article', array(
			'default' => false,
		) );

		$wp_customize->add_control( 'in_article', array(
			'label' => 'Add advert within article?',
			'section' => 'starter_theme_advertising',
			'settings' => 'in_article',
			'type' => 'checkbox',
		) );

		$wp_customize->add_setting( 'in_article_number', array(
			'default' => '',
		) );

		$wp_customize->add_control( 'in_article_number', array(
			'label' => 'Insert advert after paragraph:',
			'section' => 'starter_theme_advertising',
			'settings' => 'in_article_number',
			'type' => 'number',
		) );		

		//Social Media
		$wp_customize->add_section( 'starter_theme_social' , array(
			'title'      => __( 'Social Media', 'starter-theme' ),
			'priority'   => 50,
		) );

		$wp_customize->add_setting( 'facebook_account', array(
			'default' => '',
		) );

		$wp_customize->add_control( 'facebook_account', array(
			'label' => 'Facebook',
			'section' => 'starter_theme_social',
			'settings' => 'facebook_account',
			'type' => 'url',
		) );

		$wp_customize->add_setting( 'twitter_account', array(
			'default' => '',
		) );

		$wp_customize->add_control( 'twitter_account', array(
			'label' => 'Twitter',
			'section' => 'starter_theme_social',
			'settings' => 'twitter_account',
			'type' => 'url',
		) );

		$wp_customize->add_setting( 'instagram_account', array(
			'default' => '',
		) );

		$wp_customize->add_control( 'instagram_account', array(
			'label' => 'Instagram',
			'section' => 'starter_theme_social',
			'settings' => 'instagram_account',
			'type' => 'url',
		) );

		//Gigya
		$wp_customize->add_section( 'starter_theme_sso' , array(
			'title'      => __( 'Single Sign On', 'starter-theme' ),
			'priority'   => 50,
		) );

		$wp_customize->add_setting( 'enable_sso', array(
			'default' => true,
		) );

		$wp_customize->add_control( 'enable_sso', array(
			'label' => 'Single Sign On',
			'section' => 'starter_theme_sso',
			'type' => 'checkbox',
		) );

		$wp_customize->add_setting( 'sso_default_brand', array(
			'default' => '',
		) );

		$wp_customize->add_control( 'sso_default_brand', array(
			'label' => 'Default Brand',
			'section' => 'starter_theme_sso',
			'settings' => 'sso_default_brand',
			'type' => 'text',
		) );

		//Sailthru
		$wp_customize->add_section( 'starter_theme_sailthru' , array(
			'title'      => __( 'Sailthru', 'starter-theme' ),
			'priority'   => 50,
		) );

		$wp_customize->add_setting( 'sailthru_cookie_domain', array(
			'default' => '',
		) );

		$wp_customize->add_control( 'sailthru_cookie_domain', array(
			'label' => 'Cookie Domain',
			'section' => 'starter_theme_sailthru',
			'settings' => 'sailthru_cookie_domain',
			'type' => 'text',
		) );

		$wp_customize->add_setting( 'sailthru_horizon_support', array(
			'default' => '',
		) );

		$wp_customize->add_control( 'sailthru_horizon_support', array(
			'label' => 'Horizon Domain',
			'section' => 'starter_theme_sailthru',
			'settings' => 'sailthru_horizon_support',
			'type' => 'text',
		) );

		$wp_customize->add_setting( 'sailthru_newsletter_name', array(
			'default' => '',
		) );

		$wp_customize->add_control( 'sailthru_newsletter_name', array(
			'label' => 'Newsletter Name',
			'section' => 'starter_theme_sailthru',
			'settings' => 'sailthru_newsletter_name',
			'type' => 'text',
		) );

		//Footer
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

		//Sharing
		$wp_customize->add_section( 'starter_theme_sharing' , array(
			'title'      => __( 'Social Sharing', 'starter-theme' ),
			'priority'   => 50,
		) );

		$wp_customize->add_setting( 'share_email', array(
			'default' => true,
		) );

		$wp_customize->add_control( 'share_email', array(
			'label' => 'Email',
			'section' => 'starter_theme_sharing',
			'type' => 'checkbox',
		) );

		$wp_customize->add_setting( 'share_facebook', array(
			'default' => true,
		) );

		$wp_customize->add_control( 'share_facebook', array(
			'label' => 'Facebook',
			'section' => 'starter_theme_sharing',
			'type' => 'checkbox',
		) );

		$wp_customize->add_setting( 'share_twitter', array(
			'default' => true,
		) );

		$wp_customize->add_control( 'share_twitter', array(
			'label' => 'Twitter',
			'section' => 'starter_theme_sharing',
			'type' => 'checkbox',
		) );

		$wp_customize->add_setting( 'share_messenger', array(
			'default' => false,
		) );

		$wp_customize->add_control( 'share_messenger', array(
			'label' => 'Facebook Messenger',
			'section' => 'starter_theme_sharing',
			'type' => 'checkbox',
		) );

		$wp_customize->add_setting( 'share_google', array(
			'default' => false,
		) );

		$wp_customize->add_control( 'share_google', array(
			'label' => 'Google Plus',
			'section' => 'starter_theme_sharing',
			'type' => 'checkbox',
		) );

		$wp_customize->add_setting( 'share_linkedin', array(
			'default' => false,
		) );

		$wp_customize->add_control( 'share_linkedin', array(
			'label' => 'Linked In',
			'section' => 'starter_theme_sharing',
			'type' => 'checkbox',
		) );

		$wp_customize->add_setting( 'share_reddit', array(
			'default' => false,
		) );

		$wp_customize->add_control( 'share_reddit', array(
			'label' => 'Reddit',
			'section' => 'starter_theme_sharing',
			'type' => 'checkbox',
		) );

		$wp_customize->add_setting( 'share_tumblr', array(
			'default' => false,
		) );

		$wp_customize->add_control( 'share_tumblr', array(
			'label' => 'Tumblr',
			'section' => 'starter_theme_sharing',
			'type' => 'checkbox',
		) );

		$wp_customize->add_setting( 'share_whatsapp', array(
			'default' => false,
		) );

		$wp_customize->add_control( 'share_whatsapp', array(
			'label' => 'Whats App',
			'section' => 'starter_theme_sharing',
			'type' => 'checkbox',
		) );

		$wp_customize->add_setting( 'share_vkontakte', array(
			'default' => false,
		) );

		$wp_customize->add_control( 'share_vkontakte', array(
			'label' => 'Vkontakte',
			'section' => 'starter_theme_sharing',
			'type' => 'checkbox',
		) );
	}

	add_action('customize_register', 'starter_customiser');

?>