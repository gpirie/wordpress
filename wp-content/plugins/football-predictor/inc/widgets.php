<?php
	defined( 'ABSPATH' ) or die( 'Jog on.' );

	class pf_league_widget extends WP_Widget
	{
		function __construct()
		{
			parent::__construct(
			// Base ID of your widget
			'openweather_widget',

			// Widget name will appear in UI
			__('Prediction Standings', 'predictor'),

			// Widget description
			array( 'description' => __( 'Displays League Table Standings for logged in users.', 'predictor' ), )
			);
		}

		// Creating widget front-end
		// This is where the action happens
		public function widget( $args, $instance )
		{
			$title = ( array_key_exists('title', $instance) ? $instance['title'] : '' );

			// before and after widget arguments are defined by themes
			echo $args['before_widget'];

			if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

			echo 'boom';

			echo $args['after_widget'];
		}

		// Widget Backend
		public function form( $instance )
		{
			if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
			}
			else {
			$title = __( 'New title', 'predictor' );
			}
			// Widget admin form
			?>
			<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>

			<?php
		}

		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance )
		{
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['default_location'] = ( ! empty( $new_instance['default_location'] ) ) ? strip_tags( $new_instance['default_location'] ) : '';
			$instance['activeweather'] = ( ! empty( $new_instance['activeweather'] ) ) ? strip_tags( $new_instance['activeweather'] ) : '';
			return $instance;
		}
	} // Class openweather_widget ends here

	// Register and load the widget
	function openweather_load_widget()
	{
		register_widget( 'pf_league_widget' );
	}
	add_action( 'widgets_init', 'openweather_load_widget' );
