<?php
    defined( 'ABSPATH' ) or die();

    function predictor_get_user_prediction( $team, $match ) {
        global $wpdb;

        if( false === empty( $team ) && false === empty( $match ) ) {
            $value = $wpdb->get_results( $wpdb->prepare( "select `user_{$team}_score` from {$wpdb->prefix}predictor_user_predictions where `user_id` = %d and `match_id` = %d", get_current_user_id(), $match ) );
            $score = 'user_'. $team .'_score';
            $value = ( false === empty( $value ) ) ? $value[0]->$score : 0;
            return $value;
        }
    }

    function predictor_get_final_score( $team, $match ) {
        global $wpdb;

        if( false === empty( $match ) && false === empty( $team ) ) {
            $value = $wpdb->get_results( $wpdb->prepare( "select `final_{$team}_score` from {$wpdb->prefix}predictor_fixtures where `match_id` = %d", $match ) );
            $score = 'final_'. $team .'_score';
            $value = ( false === empty( $value ) ) ? $value[0]->$score : 0;
            return $value;
        }
    }

    function predictor_predictions_form_display() {
        $fixtures = predictor_get_fixtures();

        $predictions = array();

        if( false === empty( $fixtures ) ) {

            $html = '<form class="o-form o-form--predictions" action="//'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] .'" method="post" name="prediction_form">
                    <input type="hidden" name="predictor_post_nonce" value="'. wp_create_nonce('predictor-security') .'" />
                    <input type="hidden" id="predictor_post_back" value="%s" />
                    <input type="hidden" name="current_user" value="'. get_current_user_id() .'" />';

            $i = 0;

            foreach( $fixtures as $fixture ) {
                $html .= '<label class="o-predictionsform__label o-predictionsform__label--home u-clear u-inline-block" for="'. $fixture->home_team .'">'. $fixture->home_team .'</label>';
                $html .= '<input class="o-predictionsform__input o-predictionsform__label--away" id="'. $fixture->home_team .'" type="number" name="predictions['.$i.'][user_home_score]" min="0" value="'. predictor_get_user_prediction( 'home', $fixture->match_id ) .'" />';
                $html .= ' v ';                
                $html .= '<input class="o-predictionsform__input o-predictionsform__input--away" id="'. $fixture->away_team .'" type="number" name="predictions['.$i.'][user_away_score]" min="0" value="'. predictor_get_user_prediction( 'away', $fixture->match_id ) .'" />';
                $html .= '<label class="o-predictionsform__label o-predictionsform__label--away" for="'. $fixture->away_team .'">'. $fixture->away_team .'</label>';
                $html .= '<input type="hidden" id="fixture_id" name="predictions['.$i.'][fixture_id]" value="'. $fixture->match_id .'" />';
                
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
            $html = '<div class="o-notice o-notice--info">Please log in.</div>';
        }
        return $html;
    }

    function predictor_display_predictions_form_shortcode() {
        $html = predictor_predictions_form();

        return $html;
    }

    function predictions_form_process() {
        global $wpdb;

        if( ! predictions_form_posted_back( 'predictor_post_nonce' ) ) {
            return false;
        }

        //Have predictions been made?
        if( isset( $_POST['predictions'] ) ) {

            foreach ( $_POST['predictions'] as $prediction ) {

                $exists = $wpdb->get_row( $wpdb->prepare( "select * from {$wpdb->prefix}predictor_user_predictions where user_id = %d and match_id = %d", get_current_user_id(), $prediction['fixture_id'] ) );

                //Has user already made a prediction?
                if( ! empty( $exists ) ) {
                    
                    //Has it been changed?
                    if( $exists->user_home_score != $prediction['user_home_score'] || $exists->user_away_score != $prediction['user_away_score'] ) {
                        $wpdb->update( $wpdb->prefix . PREDICTOR_TABLE_PREDICTIONS,
                            array(
                                'user_home_score'   => esc_attr( $prediction['user_home_score'] ),
                                'user_away_score'   => esc_attr( $prediction['user_away_score'] ),
                                'prediction_date'   => current_time( 'mysql', 1 ),
                            ),
                            array( 
                                'match_id' => $prediction['fixture_id'],
                                'user_id' => get_current_user_id(),
                            )
                        );
                    }  
                }
                else {
                    //else insert new prediction
                    $wpdb->insert($wpdb->prefix . PREDICTOR_TABLE_PREDICTIONS,
                        array(
                            'user_id'           => get_current_user_id(),
                            'match_id'          => esc_attr( $prediction['fixture_id'] ),
                            'user_home_score'   => esc_attr( $prediction['user_home_score'] ),
                            'user_away_score'   => esc_attr( $prediction['user_away_score'] ),
                            'prediction_date'   => current_time( 'mysql', 1 ),
                        )
                    );     
                }
            }

        return true;

        }
        else {
            return;
        }
    }

    function predictions_form() {

        $html = ''; 
        $display_form = true;

        // Form submission? Validate and save?
        if(predictions_form_posted_back( 'predictor_post_nonce' )) {

            // Validate form!
            if($errors = predictions_form_validate()) {
                $html .= predictions_form_display_errors($errors);
            } else {
                // Save data
                $save_result = predictions_form_process();
                if($save_result) {
                    $html .= predictor_display_notification( 'Thank you for submitting your prediction(s).', 'success' );
                    //$display_form = false;
                } else {
                    // Display error.
                    $html .= predictions_form_display_errors($errors);
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
        if( ! predictions_form_posted_back( 'predictor_post_nonce' ) ) {
            return ['no_post_back' => PREDICTOR_DEFAULT_ERROR];
        }

        if( isset( $_POST['predictions'] ) ) {

	        $errors = array();
	       
	        if( empty($_POST['predictor_post_nonce']) || false == wp_verify_nonce($_POST['predictor_post_nonce'], 'predictor-security')) {
	            return ['invalid_nonce' => PREDICTOR_DEFAULT_ERROR];
	        }

	        foreach ( $_POST['predictions'] as $prediction ) {
	            
	            if( false == is_numeric( $prediction['user_home_score'] ) || empty( $prediction['user_home_score'] ) ) {
	                $errors['home_score'] = 'Please enter a score for the home team.';
	            }

	            if( false == is_numeric( $prediction['user_away_score'] ) || empty( $prediction['user_away_score'] ) ) {
	                $errors['away_score'] = 'Please enter a score for the away team.';
	            }
	        }
	    }
        
        return $errors;

    }