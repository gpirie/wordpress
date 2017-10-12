<?php
    defined( 'ABSPATH' ) or die();

    global $wp;
    $current_url = home_url( add_query_arg( array(), $wp->request ) );

    /**
     * Admin
     * ======================================
     */

    function predictor_admin_page_menu() {
        add_menu_page( 'Football Predictor', 'Football Predictor', 'edit_theme_options', 'football-predictor', 'predictor_admin_page' );
    }
    add_action( 'admin_menu', 'predictor_admin_page_menu' );

    function wpc_predictor_admin_settings()
    {
        add_settings_section( 'football-predictor', '', null, 'predictor-options' );
        
        add_settings_field( 'predictor_importer_feed_limit', 'Feed Limit', 'predictor_importer_feed_limit', 'predictor-options', 'football-predictor' );
        
        register_setting('football-predictor', 'predictor_importer_feed_limit');

    }
    add_action('admin_init', 'wpc_predictor_admin_settings');

    function predictor_admin_scripts( $hook ) {
        if( $hook != 'toplevel_page_football-predictor') {
            return;
        }
        wp_enqueue_script( 'predictor-script', plugins_url('predictor.js', __FILE__) );
    }
    add_action( 'admin_enqueue_scripts', 'predictor_admin_scripts' );

    /**
     * Predictions Form
     * ======================================
     */

    function predictions_form_posted_back() {
        return !empty($_POST['predictor_post_nonce']);
    }

    function predictions_form_thank_you() {
        return '
            <div class="o-notice o-notice--success">
                Thank you for submitting your prediction(s).
            </div>';
    }

    function predictor_get_user_prediction( $team, $match ) {
        global $wpdb;

        if( false === empty( $team ) && false === empty( $team ) ) {
            $value = $wpdb->get_results( $wpdb->prepare( "select `user_{$team}_score` from {$wpdb->prefix}predictor_user_predictions where `user_id` = %d and `match_id` = %d", get_current_user_id(), $match ) );
            $score = 'user_'. $team .'_score';
            $value = ( false === empty( $value ) ) ? $value[0]->$score : 0;
            return $value;
        }
    }

    /**
     * Front End
     * ======================================
     */

    function predictor_display_notification($text, $type = 'error') {

        echo sprintf('

            <div class="o-notice o-notice--%s">
                <p class="o-notice__message">%s</p>
            </div>

        ', $type, $text);
    }

    function predictor_get_fixtures() {
        global $wpdb;
        $fixtures = $wpdb->get_results( $wpdb->prepare( "select * from {$wpdb->prefix}predictor_fixtures where `match_time` > %s", date('Y-m-d H:m:s') ) );

        return $fixtures;
    }

    //Get upcoming fixtures
    function predictor_display_upcoming_fixtures() {
        $fixtures = predictor_get_fixtures();

        if( false === empty( $fixtures ) ) {
        
            $fixture_list = '<table class="o-fixtures">';
            $fixture_list .= '<tr>';
            $fixture_list .= '<th>Home</th>';
            $fixture_list .= '<th></th>';
            $fixture_list .= '<th>Away</th>';
            $fixture_list .= '<th>Kick-Off Time</th>';
            $fixture_list .= '<th>Venue</th>';
            $fixture_list .= '</tr>';

            foreach( $fixtures as $fixture ) {
                $fixture_list .= '<tr>';
                $fixture_list .= '<td class="o-fixtures__hometeam">'. $fixture->home_team .'</td>';
                $fixture_list .= '<td>v</td>';
                $fixture_list .= '<td class="o-fixtures__awayteam">'. $fixture->away_team .'</td>';
                $fixture_list .= '<td class="o-fixtures__awayteam">'. $fixture->match_time .'</td>';
                $fixture_list .= '<td class="o-fixtures__awayteam">'. $fixture->venue .'</td>';
                $fixture_list .= '</tr>';
            }
            $fixture_list .= '</table>';

        }
        else {
            $fixture_list = '<div class="o-notice o-notice--info">
                        There are no fixtures to display.
                    </div>';
        }

        return $fixture_list;
    }

    //Add Shortcode to display upcoming fixtures
    function predictor_display_fixtures_shortcode( $atts ) {
        $fixtures = predictor_display_upcoming_fixtures();

        return $fixtures;
    }
    add_shortcode( 'fixtures', 'predictor_display_fixtures_shortcode' );

    function predictor_predictions_form_display() {
        $fixtures = predictor_get_fixtures();

        if( false === empty( $fixtures ) ) {

            $html = '<form class="o-predictionsform" action="//'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] .'" method="post" name="prediction_form">
                    <input type="hidden" name="predictor_post_nonce" value="'. wp_create_nonce('predictor-security') .'" />
                    <input type="hidden" id="predictor_post_back" value="%s" />
                    <input type="hidden" name="current_user" value="'. get_current_user_id() .'" />';

            $i = 0;

            foreach( $fixtures as $fixture ) {
                $html .= '<label class="o-predictionsform__label o-predictionsform__label--home u-clear u-inline-block" for="'. $fixture->home_team .'">'. $fixture->home_team .'</label>';
                $html .= '<input class="o-predictionsform__input o-predictionsform__label--away" id="'. $fixture->home_team .'" type="number" name="user_home_score_'. $i .'" min="0" value="'. predictor_get_user_prediction( 'home', $fixture->match_id ) .'" />';
                $html .= ' v ';                
                $html .= '<input class="o-predictionsform__input o-predictionsform__input--away" id="'. $fixture->away_team .'" type="number" name="user_away_score_'. $i .'" min="0" value="'. predictor_get_user_prediction( 'away', $fixture->match_id ) .'" />';
                $html .= '<label class="o-predictionsform__label o-predictionsform__label--away" for="'. $fixture->away_team .'">'. $fixture->away_team .'</label>';
                $html .= '<input type="hidden" id="fixture_id_'. $i .'" name="fixture_id" value="'. $fixture->match_id .'" />';
            
                $i++;
            }
            
            $html .= '<input class="o-button o-predictionsform__button" type="submit" value="Save" />';
            $html .= '</form>';
            
        }
        else {
            $html = '<div class="o-notice o-notice--info">
                        There are no fixtures to display.
                    </div>';
        }

        return $html;
        
    }

    function predictor_predictions_form() {
        if( is_user_logged_in() ) {
            $html = predictor_predictions_form_display();
        }
        else
        {
            $html = 'Please log in.';
        }
        return $html;
    }

    function predictor_display_predictions_form_shortcode() {
        $html = predictor_predictions_form();

        return $html;
    }

    function predictor_form_get_sanitised_fields() {
        $fields = array();
    }

    function predictions_form_process() {
        global $wpdb;
        //if user already predicted on match, updated
        $exists = $wpdb->get_row( $wpdb->prepare( "select * from {$wpdb->prefix}predictor_user_predictions where user_id = %d and match_id = %d", get_current_user_id(), $_POST['fixture_id'] ) );
        
        if( ! empty( $exists ) ) {
            $wpdb->update( $wpdb->prefix . PREDICTOR_TABLE_PREDICTIONS,
                array(
                    'user_id'           => get_current_user_id(),
                    'match_id'          => $_POST['fixture_id'],
                    'user_home_score'   => $_POST['user_home_score'],
                    'user_away_score'   => $_POST['user_away_score'],
                    'prediction_date'   => current_time( 'mysql', 1 ),
                ),
                array( 'prediction_id' => 1 )
            );   
            return true;   
        }
        else {
            //else insert new prediction
            $wpdb->insert($wpdb->prefix . PREDICTOR_TABLE_PREDICTIONS,
                array(
                    'user_id'           => get_current_user_id(),
                    'match_id'          => $_POST['fixture_id'],
                    'user_home_score'   => $_POST['user_home_score'],
                    'user_away_score'   => $_POST['user_away_score'],
                    'prediction_date'   => current_time( 'mysql', 1 ),
                )
            );   
            return true;     
        }
    }

    function predictions_form() {

        $html = ''; 
        $display_form = true;

        // Form submission? Validate and save?
        if(predictions_form_posted_back()) {

            // Validate form!
            if($errors = predictions_form_validate()) {
                $html .= predictions_form_display_errors($errors);
            } else {
                // Save data
                $save_result = predictions_form_process();
                
                if($save_result) {
                    $html .= predictions_form_thank_you();
                    //$display_form = false;
                } else {
                    // Display error.
                    $html .= 'errors';
                }
            }
        }

        // Do we need to display the form (first time page visit or validation error)?
        if($display_form) {
            $html .= predictor_predictions_form();
        }

        return $html;
    }
    add_shortcode( 'predictions', 'predictions_form' );

    function predictions_form_validate() {
        if( ! predictions_form_posted_back() ) {
            return ['no_post_back' => PREDICTOR_DEFAULT_ERROR];
        }

        $errors = array();

        if( empty($_POST['predictor_post_nonce']) || false == wp_verify_nonce($_POST['predictor_post_nonce'], 'predictor-security')) {
            return ['invalid_nonce' => PREDICTOR_DEFAULT_ERROR];
        }

        if( false == is_numeric( $_POST['user_home_score'] ) || empty( $_POST['user_home_score'] ) ) {
            $errors['home_score'] = 'Please enter a score for the home team.';
        }

        if( false == is_numeric( $_POST['user_away_score'] ) || empty( $_POST['user_away_score'] ) ) {
            $errors['away_score'] = 'Please enter a score for the away team.';
        }

        return $errors;

    }

    function predictions_form_display_errors($errors) {

        $html = '';

        if(!empty($errors)) {
            $html .= '<ul class="o-notice o-notice--error">';
            foreach ($errors as $key => $error_message) {
                $html .= sprintf('<li data-field="%s">%s</li>', $key, $error_message);
            }
            $html .= '</ul>';
        }

        return $html;
    }