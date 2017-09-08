<?php
	function gpwd_customiser( $wp_customize )
	{
		//Options
		$wp_customize->add_section( 'gpwd_theme_options' , array(
			'title'      => __( 'Site Options', 'gpwd-theme' ),
			'priority'   => 50,
		) );
		
		$wp_customize->add_setting( 'contact_email', array(
			'default' => '',
		) );

		$wp_customize->add_control( 'contact_email', array(
			'label' => 'Email Address',
			'section' => 'gpwd_theme_options',
			'settings' => 'contact_email',
			'type' => 'email',
		) );
		$wp_customize->add_setting( 'contact_phone_number', array(
			'default' => '',
		) );

		$wp_customize->add_control( 'contact_phone_number', array(
			'label' => 'Phone Number',
			'section' => 'gpwd_theme_options',
			'settings' => 'contact_phone_number',
			'type' => 'email',
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

		$wp_customize->add_section( 'gpwd_theme_social' , array(
			'title'      => __( 'Social Media Accounts', 'gpwd-theme' ),
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
						'section' => 'gpwd_theme_social',
						'settings' => $link['slug'],
						'type' => 'url',
					) 
				) 
			);
		}

		//Footer
		$wp_customize->add_section( 'gpwd_theme_footer' , array(
			'title'      => __( 'Footer', 'gpwd-theme' ),
			'priority'   => 50,
		) );

		$wp_customize->add_setting( 'copyright', array(
			'default' => '',
		) );

		$wp_customize->add_control( 'copyright', array(
			'label' => 'Copyright',
			'section' => 'gpwd_theme_footer',
			'settings' => 'copyright',
			'type' => 'text',
		) );
	}
		
	add_action('customize_register', 'gpwd_customiser');

?>