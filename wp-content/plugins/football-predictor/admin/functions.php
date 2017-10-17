<?php
	defined( 'ABSPATH' ) or die();

	function predictor_admin_manage_final_scores() {
		$fixtures = predictor_get_fixtures();

        $predictions = array();

        if( false === empty( $fixtures ) ) {
            ?>
            	<form class="o-form o-form--predictions" action="<?php echo( wp_nonce_url( admin_url( 'admin.php?page=football-predictor&notice=scores-updated' ), 'pa-importer-run-now' ) ); ?>" method="post" name="prediction_form">
                    <input type="hidden" name="predictor_post_nonce" value="<?php echo wp_create_nonce('predictor-security');?>" />
                    <input type="hidden" id="predictor_post_back" value="%s" />
                    <input type="hidden" name="current_user" value="<?php echo get_current_user_id();?>" />

	                <?php
			            $i = 0;
			            foreach( $fixtures as $fixture ) {
			            	?>
			                <label class="o-predictionsform__label o-predictionsform__label--home u-clear u-inline-block" for="<?php echo $fixture->home_team;?>"><?php echo $fixture->home_team;?></label>
			                <input class="o-predictionsform__input o-predictionsform__label--away" id="<?php echo $fixture->home_team;?>" type="number" name="predictions[<?php echo $i;?>][final_home_score]" min="0" value="<?php echo predictor_get_final_score( 'home', $fixture->match_id );?>" />
			                v               
			                <input class="o-predictionsform__input o-predictionsform__input--away" id="<?php echo $fixture->away_team;?>" type="number" name="predictions[<?php echo $i;?>][final_away_score]" min="0" value="<?php echo predictor_get_final_score( 'away', $fixture->match_id );?>" />
			                <label class="o-predictionsform__label o-predictionsform__label--away" for="<?php echo $fixture->away_team;?>"><?php echo $fixture->away_team;?></label>
			                <input type="hidden" id="fixture_id" name="predictions[<?php echo $i;?>][fixture_id]" value="<?php echo $fixture->match_id;?>" />
			                <?php
			                $i++;
			            }

			            submit_button( 'Save Scores' );
			        ?>

	            </form>
            <?php
        }
        else {
            ?>
            	<div class="o-notice o-notice--info">
                    There are no fixtures to display.
                </div>
            <?php
        }

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
            join wp_predictor_fixtures f
            on p.match_id = f.match_id" );

            foreach( $scores as $score ) {
                //If prediction is the correct score
                if( $score->user_home_score == $score->final_home_score && $score->user_away_score == $score->final_away_score ) {
                    $points = 10;
                }
            }

            if( isset( $_POST['predictions'] ) ) {
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
    add_action('admin_init', 'predictor_process_user_points');