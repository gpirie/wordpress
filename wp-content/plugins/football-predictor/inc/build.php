<?php

	defined( 'ABSPATH' ) or die();
	
	//Run the necessary functions when plugin activated.
	function predictor_install() {
		predictor_create_database_tables();
	}
	
	//Create required database tables.
	function predictor_create_database_tables() 
	{
		//Create table for fixtures
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$sql = "CREATE TABLE {$wpdb->prefix}predictor_fixtures (
				match_id INT NOT NULL AUTO_INCREMENT,
				competition_id INT NOT NULL,
				home_team VARCHAR(100) NOT NULL,
				away_team VARCHAR(100) NOT NULL,
				match_time DATETIME NOT NULL,
				venue VARCHAR(100) NOT NULL,
				PRIMARY KEY  (match_id)
			) COLLATE {$wpdb->collate}";

		dbDelta( $sql );

		//Create table for competitions
		$sql = "CREATE TABLE {$wpdb->prefix}predictor_competitions (
				comp_id INT NOT NULL AUTO_INCREMENT,
				comp_name VARCHAR(100) NOT NULL,
				PRIMARY KEY  (comp_id)
			) COLLATE {$wpdb->collate}";

		dbDelta( $sql );

		//Create table for user predictions
		$sql = "CREATE TABLE {$wpdb->prefix}predictor_user_predictions (
				prediction_id INT NOT NULL AUTO_INCREMENT,
				user_id INT NOT NULL,
				match_id INT NOT NULL,
				user_home_score INT NOT NULL,
				user_away_score INT NOT NULL,
				final_home_score INT NOT NULL,
				final_away_score INT NOT NULL,
				user_points INT NOT NULL,
				PRIMARY KEY  (prediction_id)
			) COLLATE {$wpdb->collate}";

		dbDelta( $sql );

		//Create table for user predictions
		$sql = "CREATE TABLE {$wpdb->prefix}predictor_leagues (
				league_id INT NOT NULL AUTO_INCREMENT,
				league_name VARCHAR(100) NOT NULL,
				PRIMARY KEY  (league_id)
			) COLLATE {$wpdb->collate}";

		dbDelta( $sql );
	}	