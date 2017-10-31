<?php
	defined( 'ABSPATH' ) or die();

    // Register Widgets
    function register_foo_widget() {
        register_widget( 'Predictor_League_Table' );
    }
    //add_action( 'widgets_init', 'register_foo_widget' );

    function predictor_admin_settings()
    {
        add_settings_section( 'predictor', '', null, 'predictor-options' );
        //Win points
        add_settings_field( 'predictor_corect_score_points', 'Correct Score Points', 'predictor_corect_score_points', 'predictor-options', 'predictor' );

        register_setting('predictor', 'predictor_corect_score_points');

        //Correct Outcome Points
        add_settings_field( 'predictor_corect_outcome_points', 'Correct Outcome Points', 'predictor_corect_outcome_points', 'predictor-options', 'predictor' );

        register_setting('predictor', 'predictor_corect_outcome_points');

    }
    add_action('admin_init', 'predictor_admin_settings');

    function predictor_corect_score_points()
    {
        ?>
            <input type="number" min="0" id="predictor_corect_score_points" name="predictor_corect_score_points" value="<?php esc_attr_e( get_option( 'predictor_corect_score_points' ) );?>" />
        <?php
    }

    function predictor_corect_outcome_points()
    {
        ?>
            <input type="number" min="0" id="predictor_corect_outcome_points" name="predictor_corect_outcome_points" value="<?php esc_attr_e( get_option( 'predictor_corect_outcome_points' ) );?>" />
        <?php
    }

	function predictor_admin_manage_final_scores() {
		//Get stages
        $stages = predictor_get_competition_stages();

        $predictions = array();
        ?>
            <form class="o-form o-form--predictions" action="<?php echo( wp_nonce_url( admin_url( 'admin.php?page=predictor-fixtures&notice=scores-updated' ), 'predictor-update-scores' ) ); ?>" method="post" name="prediction_form">
                <input type="hidden" name="predictor_post_nonce" value="<?php echo wp_create_nonce('predictor-security');?>" />
                <input type="hidden" id="predictor_post_back" value="%s" />
                <input type="hidden" name="current_user" value="<?php echo get_current_user_id();?>" />

                <table>
                    <?php
                        $i = 0;

                        foreach( $stages as $stage ) {

                            ?>
                                <tr>
                                    <td><h2><?php echo $stage->stage;?></h2></td>
                                </tr>

                            <?php
                            $fixtures = predictor_get_fixtures( $stage->stage );

                            if( false === empty( $fixtures ) ) {

                                foreach( $fixtures as $fixture ) {

        			            	?>
                                    <tr>
            			                <td><label class="o-predictionsform__label o-predictionsform__label--home u-clear u-inline-block" for="<?php echo $fixture->home_team;?>"><?php echo $fixture->home_team;?></label></td>
            			                <td><input class="o-predictionsform__input o-predictionsform__label--away" id="<?php echo $fixture->home_team;?>" type="number" name="predictions[<?php echo $i;?>][final_home_score]" min="0" value="<?php echo predictor_get_final_score( 'home', $fixture->match_id );?>" /></td>
            			                <td>v</td>
            			                <td><input class="o-predictionsform__input o-predictionsform__input--away" id="<?php echo $fixture->away_team;?>" type="number" name="predictions[<?php echo $i;?>][final_away_score]" min="0" value="<?php echo predictor_get_final_score( 'away', $fixture->match_id );?>" /></td>
            			                <td><label class="o-predictionsform__label o-predictionsform__label--away" for="<?php echo $fixture->away_team;?>"><?php echo $fixture->away_team;?></label></td>
            			                <td>
											<input type="hidden" id="fixture_id" name="predictions[<?php echo $i;?>][fixture_id]" value="<?php echo $fixture->match_id;?>" />
											<input type="hidden" id="fixture_id" name="predictions[<?php echo $i;?>][home_penalties]" value="<?php echo $fixture->home_penalties;?>" />
											<input type="hidden" id="fixture_id" name="predictions[<?php echo $i;?>][away_penalties]" value="<?php echo $fixture->away_penalties;?>" />
										</td>
            			             </tr>
                                    <?php
        			                $i++;
        			            }
                            }
                            else {
                                ?>
                                    <div class="o-notice o-notice--info">
                                        There are no fixtures to display.
                                    </div>
                                <?php
                            }
                        }
                        ?>
                        <tr>
                            <td>
                                <?php submit_button( 'Save Scores' );?>
                            </td>
                        </tr>
                    </table>

    	            </form>
                <?php
                    do_action( 'predictor_admin_process_scores' );
            }

    function predictor_get_users() {
        global $wpdb;

        $users = $wpdb->get_results( "select user_id from {$wpdb->prefix}predictor_fixtures group by `user_id`" );

        return $users;
    }


	function predictor_admin_process_scores() {
		global $wpdb;

		$fixtures = predictor_get_fixtures();

		//Have predictions been made?
        if( isset( $_POST['predictions'] ) ) {

			foreach ( $_POST['predictions'] as $prediction ) {

                //Update final scores
                $wpdb->update( $wpdb->prefix . PREDICTOR_TABLE_FIXTURES,
                    array(
                        'final_home_score'   => esc_attr( $prediction['final_home_score'] ),
                        'final_away_score'   => esc_attr( $prediction['final_away_score'] ),
                        'home_penalties'   => esc_attr( $prediction['home_penalties'] ),
                        'away_penalties'   => esc_attr( $prediction['away_penalties'] ),
                    ),
                    array(
                        'match_id' => $prediction['fixture_id']
                    )
                );

            }

            //Update Scores
            predictor_process_user_points();

			return true;
        }
        else {
            return;
        }
	}


    function predictor_process_user_points() {
        global $wpdb;
        //Update Scores
        $scores = $wpdb->get_results( "select f.match_id, p.user_home_score, p.user_away_score, f.final_home_score, f.final_away_score
            FROM {$wpdb->prefix}predictor_user_predictions p
            join {$wpdb->prefix}predictor_fixtures f
            on p.match_id = f.match_id" );
		
        foreach( $scores as $score ) {
            //If prediction is the correct score
            if( $score->user_home_score == $score->final_home_score && $score->user_away_score == $score->final_away_score ) {
                $points = PREDICTOR_CORRECT_SCORE_POINTS;
            }
            elseif( $score->user_home_score > $score->user_away_score && $score->final_home_score > $score->final_away_score ) {
                $points = PREDICTOR_CORRECT_OUTCOME_POINTS;
            }
            elseif( $score->user_away_score > $score->user_home_score && $score->final_away_score > $score->final_home_score ) {
                $points = PREDICTOR_CORRECT_OUTCOME_POINTS;
            }
            elseif( $score->user_away_score == $score->user_home_score && $score->final_away_score == $score->final_home_score ) {
                $points = PREDICTOR_CORRECT_OUTCOME_POINTS;
            }
            else {
                $points = 0;
            }

            $wpdb->update( $wpdb->prefix . PREDICTOR_TABLE_PREDICTIONS,
                array(
                    'user_points'   => $points,
                ),
                array(
                    'match_id' => $score->match_id
                )
            );
        }
    }
