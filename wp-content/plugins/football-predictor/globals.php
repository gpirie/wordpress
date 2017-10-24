<?php
	defined( 'ABSPATH' ) or die( 'Jog on.' );

	// ---------------------------------------------
	// Various
	// ---------------------------------------------

	define( 'PREDICTOR_TABLE_PREDICTIONS', 'predictor_user_predictions' );
	define( 'PREDICTOR_TABLE_FIXTURES', 'predictor_fixtures' );
	define( 'PREDICTOR_TABLE_LEAGUES', 'predictor_leagues' );

	define( 'PREDICTOR_CORRECT_SCORE_POINTS', ( get_option( 'predictor_corect_score_points' ) ) ? get_option( 'predictor_corect_score_points' ) : 10 );
	define( 'PREDICTOR_CORRECT_OUTCOME_POINTS', ( get_option( 'predictor_corect_outcome_points' ) ) ? get_option( 'predictor_corect_outcome_points' ) : 10 );


	// ---------------------------------------------
	// Error Handling
	// ---------------------------------------------

	// Generic error message to be displayed in the event of VOW form error.
	define('PREDICTOR_DEFAULT_ERROR', 'There was an error while processing this form. Please try again. If the issue persists then please don\'t hesitate to contact us.');
	