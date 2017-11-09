<?php
    defined( 'ABSPATH' ) or die();

    // Add users to a leagues
    function predictor_join_league_form_display() {

        $league = array();

        $html =
            '<form class="o-form o-form--joinleague" action="//'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] .'" method="post" name="joinleague_form">
                <input type="hidden" name="predictor_join_league_nonce" value="'. wp_create_nonce('predictor-join-league-security') .'" />
                <input type="hidden" name="league[league_users]" value="<?php echo get_current_user_id();?>" />

                <label class="o-joinleague__label o-joinleague__label--home u-clear u-inline-block" for="league[league_id]">League Code</label>
                <input class="o-joinleague__input o-joinleague__label--away" id="league[league_id]" type="text" name="league[league_id]" value="" />

                <input class="o-button o-joinleague__button" type="submit" value="Join League" />
            </form>';

        return $html;
    }

    function predictor_join_league_form() {
        if( is_user_logged_in() ) {
            $html = predictor_join_league_form_display();
        }
        else
        {
            $html = '<div class="o-notice o-notice--info">Please log in.</div>';
        }
        return $html;
    }

    function predictor_join_league_form_process() {
        global $wpdb;

        if( ! predictions_form_posted_back( 'predictor_join_league_nonce' ) ) {
            return false;
        }

        if( isset( $_POST['league'] ) ) {
            $wpdb->update($wpdb->prefix . PREDICTOR_TABLE_LEAGUES,
                array( 'league_users' => get_current_user_id() ),
                array( 'league_id' => $_POST['league']['league_id'] )
            );

            return true;
        }
        else {
            return;
        }
    }

    function predictor_join_league_form_run() {

        $html = '';
        $display_form = true;

        // Form submission? Validate and save?
        if(predictions_form_posted_back( 'predictor_join_league_nonce' )) {
            // Validate form!
            if($errors = predictor_join_league_form_validate()) {
                $html .= predictions_form_display_errors($errors);
            } else {
                // Save data
                $save_result = predictor_join_league_form_process();
                if($save_result) {
                    $html .= predictor_display_notification( 'You have joined the league.', 'success' );
                    $display_form = false;
                } else {
                    // Display error.
                    $html .= predictions_form_display_errors($errors);
                }
            }
        }

        // Do we need to display the form (first time page visit or validation error)?
        if($display_form) {
            $html .= predictor_join_league_form();
        }

        return $html;
    }
    add_shortcode( 'join_league', 'predictor_join_league_form_run' );

    function predictor_join_league_form_validate() {
        if( isset( $_POST['league'] ) ) {
            $errors = array();

            $league = $_POST['league'];

            if( empty($_POST['predictor_join_league_nonce']) || false == wp_verify_nonce($_POST['predictor_join_league_nonce'], 'predictor-join-league-security')) {
                return ['invalid_nonce' => PREDICTOR_DEFAULT_ERROR];
            }

            if( empty( $_POST['league']['league_id'] ) ) {
                $errors['league_name'] = 'Please enter a code.';
            }

            return $errors;
        }

        return $errors;
    }
