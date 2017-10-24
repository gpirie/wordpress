<?php
    defined( 'ABSPATH' ) or die();

    function predictor_create_league_form() {

        $league = array();

        $html = 
            '<form class="o-form o-form--createleague" action="//'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] .'" method="post" name="prediction_form">
                <input type="hidden" name="predictor_league_nonce" value="'. wp_create_nonce('predictor-league-security') .'" />
                <input type="hidden" name="league[league_owner]" value="<?php echo get_current_user_id();?>" />

                <label class="o-createleague__label o-createleague__label--home u-clear u-inline-block" for="league[league_name]">League Name</label>
                <input class="o-createleague__input o-createleague__label--away" id="league[league_name]" type="text" name="league[league_name]" value="" />
                                        
                <input class="o-button o-createleague__button" type="submit" value="Create League" />
            </form>';
        
 
        return $html;
    }
    add_shortcode( 'create_league', 'predictor_create_league_form' );

    function predictor_create_league_insert() {
        global $wpdb;

        if( isset( $_POST['league'] ) ) {

            $wpdb->insert($wpdb->prefix . PREDICTOR_TABLE_LEAGUES,
                array(
                    'league_name'           => esc_attr( $_POST['league']['league_name'] ),
                    'league_owner'          => get_current_user_id(),
                )
            );
        }    
    }

    function predictor_create_league_form_process() {

        $html = ''; 
        $display_form = true;

        // Form submission? Validate and save?
        if( predictions_form_posted_back( 'predictor_league_nonce' ) ) {
echo 'boom';
wp_die();
            // Validate form!
            if($errors = prediction_create_league_form_validate()) {
                $html .= predictions_form_display_errors($errors);
            } else {

                // Save data
                $save_result = predictor_create_league_insert();
                
                if($save_result) {
                    $html .= predictor_display_notification( 'Your league has been created.', 'success' );
                    //$display_form = false;
                } else {
                    // Display error.
                    $html .= predictions_form_display_errors($errors);
                }
            }
        }

        // Do we need to display the form (first time page visit or validation error)?
        if($display_form) {
            $html .= predictor_create_league_form();
        }

        return $html;

    }
    
    add_action( 'admin_post_nopriv_predictor_create_league_form_process', 'predictor_create_league_form_process' );
    add_action( 'admin_post_predictor_create_league_form_process', 'predictor_create_league_form_process' );

    function prediction_create_league_form_validate() {

        if( isset( $_POST['league'] ) ) {
            $errors = array();

            $league = $_POST['league'];
            
            if( empty($_POST['predictor_league_nonce']) || false == wp_verify_nonce($_POST['predictor_league_nonce'], 'predictor-security')) {
                return ['invalid_nonce' => PREDICTOR_DEFAULT_ERROR];
            }

            if( empty( $_POST['league']['league_name'] ) ) {
                $errors['league_name'] = 'Please enter a name for the league.';
            }
            
            return $errors;
        }

    }