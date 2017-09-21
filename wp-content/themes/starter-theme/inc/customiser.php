<?php
	defined( 'ABSPATH' ) or die( 'Nice try' );
	
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

		$wp_customize->add_setting( 'in_article_number_short_form', array(
			'default' => '',
		) );

		$wp_customize->add_control( 'in_article_number_short_form', array(
			'label' => 'Short form posts: Insert advert after paragraph:',
			'section' => 'starter_theme_advertising',
			'settings' => 'in_article_number_short_form',
			'type' => 'number',
		) );	

		$wp_customize->add_setting( 'in_article_number_medium_form', array(
			'default' => '',
		) );

		$wp_customize->add_control( 'in_article_number_medium_form', array(
			'label' => 'Medium form posts: Insert advert after paragraph:',
			'section' => 'starter_theme_advertising',
			'settings' => 'in_article_number_medium_form',
			'type' => 'number',
		) );	

		$wp_customize->add_setting( 'in_article_number_long_form', array(
			'default' => '',
		) );

		$wp_customize->add_control( 'in_article_number_long_form', array(
			'label' => 'Long form posts: Insert advert after paragraph:',
			'section' => 'starter_theme_advertising',
			'settings' => 'in_article_number_long_form',
			'type' => 'number',
		) );		


		$wp_customize->add_setting( 'in_article_align', array(
			'default' => '',
		) );

		$wp_customize->add_control( 'in_article_align', array(
			'label' => 'Alignment of advert',
			'section' => 'starter_theme_advertising',
			'settings' => 'in_article_align',
			'type'     => 'select',
			'choices'  => array(
				'alignleft'  => 'Left',
				'alignright' => 'Right',
				'aligncenter'=> 'Centre'
			),
		) );		

		//Social Media
		$social_links = array();
		$social_links[] = array(
			'slug'	=>	'facebook_account',
			'label'	=>	__('Facebook Page Link')
		);
		$social_links[] = array(
			'slug'	=>	'twitter_account',
			'label'	=>	__('Twitter Page Link')
		);
		$social_links[] = array(
			'slug'	=>	'instagram_account',
			'label'	=>	__('Instagram Page Link')
		);

		$wp_customize->add_section( 'starter_theme_social' , array(
			'title'      => __( 'Social Media Accounts', 'starter-theme' ),
			'priority'   => 50,
		) );

		foreach( $social_links as $link ) {
			// SETTINGS
			$wp_customize->add_setting($link['slug']);

			$wp_customize->add_control
			(
				new WP_Customize_Control
				(
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

		//Socialize Networks
		$wp_customize->add_section( 'starter_theme_sharing' , array(
			'title'      => __( 'Social Sharing', 'starter-theme' ),
			'priority'   => 50,
		) );

		$sharing_links = array();
		$sharing_links[] = array(
			'slug'	=>	'share_email',
			'label'	=>	__('Email')
		);
		$sharing_links[] = array(
			'slug'	=>	'share_facebook',
			'label'	=>	__('Facebook')
		);
		$sharing_links[] = array(
			'slug'	=>	'share_twitter',
			'label'	=>	__('Twitter')
		);
		$sharing_links[] = array(
			'slug'	=>	'share_messenger',
			'label'	=>	__('Facebook Messenger')
		);
		$sharing_links[] = array(
			'slug'	=>	'share_google',
			'label'	=>	__('Google +')
		);
		$sharing_links[] = array(
			'slug'	=>	'share_linkedin',
			'label'	=>	__('Linked In')
		);
		$sharing_links[] = array(
			'slug'	=>	'share_reddit',
			'label'	=>	__('Reddit')
		);
		$sharing_links[] = array(
			'slug'	=>	'share_tumblr',
			'label'	=>	__('Tumblr')
		);
		$sharing_links[] = array(
			'slug'	=>	'share_whatsapp',
			'label'	=>	__('WhatsApp')
		);
		$sharing_links[] = array(
			'slug'	=>	'share_vkontakte',
			'label'	=>	__('VKontakte')
		);

		foreach( $sharing_links as $link ) 
		{
			
			$wp_customize->add_setting($link['slug']);

			$wp_customize->add_control(
				new WP_Customize_Control
				(
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

	add_action('customize_register', 'starter_customiser');

?>