<?php
	defined( 'ABSPATH' ) or die( 'Nice try' );
	
	function starter_customiser( $wp_customize )
	{
		//Social Media
		$social_links = array();
		$social_links[] = array(
			'slug'	=>	'social_facebook_account',
			'label'	=>	__('Facebook Page Link')
		);
		$social_links[] = array(
			'slug'	=>	'social_twitter_account',
			'label'	=>	__('Twitter Page Link')
		);
		$social_links[] = array(
			'slug'	=>	'social_instagram_account',
			'label'	=>	__('Instagram Page Link')
		);
		$social_links[] = array(
			'slug'	=>	'social_pinterest_account',
			'label'	=>	__('Pinterest Page Link')
		);
		$social_links[] = array(
			'slug'	=>	'social_linkedin_account',
			'label'	=>	__('Linked In Page Link')
		);
		$social_links[] = array(
			'slug'	=>	'social_googleplus_account',
			'label'	=>	__('Google Plus Page Link')
		);
		$social_links[] = array(
			'slug'	=>	'social_youtube_account',
			'label'	=>	__('YouTube Page Link')
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