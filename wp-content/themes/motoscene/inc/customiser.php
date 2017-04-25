<?php
	function starter_customiser( $wp_customize )
	{
		//Advertising Section
		$wp_customize->add_section( 'starter_theme_advertising' , array(
			'title'      => __( 'Advertising', 'ms-theme' ),
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
			'title'      => __( 'Social Media', 'ms-theme' ),
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

		//Footer
		$wp_customize->add_section( 'starter_theme_footer' , array(
			'title'      => __( 'Footer', 'ms-theme' ),
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
			'title'      => __( 'Social Sharing', 'ms-theme' ),
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

		$wp_customize->add_setting( 'share_whatsapp', array(
			'default' => false,
		) );

		$wp_customize->add_control( 'share_whatsapp', array(
			'label' => 'Whats App',
			'section' => 'starter_theme_sharing',
			'type' => 'checkbox',
		) );
	}

	add_action('customize_register', 'starter_customiser');

?>