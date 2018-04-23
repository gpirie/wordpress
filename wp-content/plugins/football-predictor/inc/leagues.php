<?php
    defined( 'ABSPATH' ) or die();

    function predictor_create_league_form_display() {
        $league = array();

        $html =
            '<form class="o-form o-form--createleague" action="//'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] .'" method="post" name="createleague_form">
                <input type="hidden" name="predictor_league_nonce" value="'. wp_create_nonce('predictor-league-security') .'" />
                <input type="hidden" name="league[league_owner]" value="<?php echo get_current_user_id();?>" />

                <label class="o-createleague__label o-createleague__label--home u-clear u-inline-block" for="league[league_name]">League Name</label>
                <input class="o-createleague__input o-createleague__label--away" id="league[league_name]" type="text" name="league[league_name]" value="" />

                <input class="o-button o-createleague__button" type="submit" value="Create League" />
            </form>';

        return $html;
    }

    function predictor_create_league_form() {
        if( is_user_logged_in() ) {
            $html = predictor_create_league_form_display();
        }
        else
        {
            $html = '<div class="o-notice o-notice--info">Please log in.</div>';
        }
        return $html;
    }

    function predictor_create_league_form_process() {
        global $wpdb;

        if( ! predictions_form_posted_back( 'predictor_league_nonce' ) ) {
            return false;
        }

        if( isset( $_POST['league']['league_name'] ) ) {

            $wpdb->insert($wpdb->prefix . PREDICTOR_TABLE_LEAGUES,
                array(
                    'league_name'           => esc_attr( $_POST['league']['league_name'] )
                )
            );

            return true;
        }
        else {
            return;
        }
    }

    function predictor_create_league_form_run() {

        $html = '';
        $display_form = true;

        // Form submission? Validate and save?
        if(predictions_form_posted_back( 'predictor_league_nonce' )) {
            // Validate form!
            if($errors = predictor_league_form_validate()) {
                $html .= predictions_form_display_errors($errors);
            } else {
                // Save data
                $save_result = predictor_create_league_form_process();
                if($save_result) {
                    $html .= predictor_display_notification( 'Thank you for creating a league. Now, share the league code.', 'success' );
                    $display_form = false;
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
    add_shortcode( 'create_league', 'predictor_create_league_form_run' );

    function predictor_league_form_validate() {
        if( isset( $_POST['league'] ) ) {
            $errors = array();

            $league = $_POST['league'];

            if( empty($_POST['predictor_league_nonce']) || false == wp_verify_nonce($_POST['predictor_league_nonce'], 'predictor-league-security')) {
                return ['invalid_nonce' => PREDICTOR_DEFAULT_ERROR];
            }

            if( empty( $_POST['league']['league_name'] ) ) {
                $errors['league_name'] = 'Please enter a name for the league.';
            }

            return $errors;
        }

        return $errors;
    }

    function prediction_get_user_info( $user_id ) {
		$user_info = get_userdata( $user_id );

		return $user_info->user_login;
	}

	function prediction_get_user_points() {
		global $wpdb;

		$user_points = $wpdb->get_results( "select user_id, sum(user_points) as points
			FROM {$wpdb->prefix}predictor_user_predictions
			GROUP by user_id
			ORDER by points desc" );

		if( false === empty( $user_points ) ) {
			?>
				<table>
					<tr>
						<th>User</th>
						<th>Points</th>
					</tr>
			<?php
				foreach( $user_points as $point ) {
				?>
					<tr>
						<td><?php echo prediction_get_user_info($point->user_id);?></td>
						<td><?php echo $point->points;?></td>
					</tr>
				<?php
			}
			?>
				</table>
			<?php
		}
	}

	function prediction_display_league_standings() {
		global $wpdb;
	}
