<?php
	defined( 'ABSPATH' ) or die( 'Jog on.' );

	class Predictor_League_Table extends WP_Widget {

		function __construct() {
			parent::__construct(
				'predictor_league_table_widget', // Base ID
				esc_html__( 'Football Predictor Display League Table', 'text_domain' ), // Name
				array( 'description' => esc_html__( 'Displays League Table Standings for logged in users.', 'text_domain' ), ) // Args
			);
		}

		public function widget( $args, $instance ) {
			echo $args['before_widget'];
			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
			}
			echo esc_html__( 'Hello, World!', 'text_domain' );
			echo $args['after_widget'];
		}

		public function form( $instance ) {
			$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
			?>
			<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<?php 
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

			return $instance;
		}

	} // class Predictor_League_Table