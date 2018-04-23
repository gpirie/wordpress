<?php
    defined( 'ABSPATH' ) or die( 'Jog on.' );
	/**
     * Admin
     * ======================================
     */

    function predictor_admin_page_menu() {
        add_menu_page( 'Football Predictor', 'Football Predictor', 'edit_theme_options', 'football-predictor', 'predictor_admin_page', 'dashicons-awards' );
        add_submenu_page( 'football-predictor', 'Fixtures & Scores', 'Fixtures & Scores', 'manage_options', 'predictor-fixtures', 'predictor_manage_fixtures' );
        add_submenu_page( 'football-predictor', 'Users', 'Users', 'manage_options', 'predictor-users', 'predictor_manage_users' );
        add_submenu_page( 'football-predictor', 'Leagues', 'Leagues', 'manage_options', 'predictor-leagues', 'predictor_manage_leagues' );
        add_submenu_page( 'football-predictor', 'Options', 'Options', 'manage_options', 'predictor-options', 'predictor_manage_options' );
    }
    add_action( 'admin_menu', 'predictor_admin_page_menu' );

    function predictor_admin_scripts( $hook ) {
        if( $hook != 'toplevel_page_football-predictor') {
            return;
        }
        wp_enqueue_script( 'predictor-script', plugins_url('predictor.js', __FILE__) );
    }
    add_action( 'admin_enqueue_scripts', 'predictor_admin_scripts' );