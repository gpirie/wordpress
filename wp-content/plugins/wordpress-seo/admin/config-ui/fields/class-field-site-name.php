<?php
/**
 * WPSEO plugin file.
 *
 * @package WPSEO\Admin\ConfigurationUI
 */

/**
 * Class WPSEO_Config_Field_Site_Name
 */
class WPSEO_Config_Field_Site_Name extends WPSEO_Config_Field {

	/**
	 * WPSEO_Config_Field_Site_Name constructor.
	 */
	public function __construct() {
		parent::__construct( 'siteName', 'Input' );

		$this->set_property( 'label', __( 'Website name', 'wordpress-seo' ) );

		$this->set_property( 'explanation', __( 'Google shows your website\'s name in the search results, if you want to change it, you can do that here.', 'wordpress-seo' ) );
	}

	/**
	 * Set adapter
	 *
	 * @param WPSEO_Configuration_Options_Adapter $adapter Adapter to register lookup on.
	 */
	public function set_adapter( WPSEO_Configuration_Options_Adapter $adapter ) {
		$adapter->add_custom_lookup(
			$this->get_identifier(),
			array( $this, 'get_data' ),
			array( $this, 'set_data' )
		);
	}

	/**
	 * Get the data from the stored options.
	 *
	 * @return null|string
	 */
	public function get_data() {
		if ( WPSEO_Options::get( 'website_name', false ) ) {
			return WPSEO_Options::get( 'website_name' );
		}

		return get_bloginfo( 'name' );
	}

	/**
	 * Set the data in the options.
	 *
	 * @param {string} $data The data to set for the field.
	 *
	 * @return bool Returns true or false for successful storing the data.
	 */
	public function set_data( $data ) {
<<<<<<< HEAD
		$value = $data;

		$option                 = WPSEO_Options::get_option( 'wpseo' );
		$option['website_name'] = $value;

		update_option( 'wpseo', $option );

		// Check if everything got saved properly.
		$saved_option = WPSEO_Options::get_option( 'wpseo' );

		return ( $saved_option['website_name'] === $option['website_name'] );
=======
		return WPSEO_Options::set( 'website_name', $data );
>>>>>>> 183795979354da53b136df92de933c2cb84a544a
	}
}
