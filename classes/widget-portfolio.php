<?php

/* Register the Portfolio widget. */
function ChillThemes_Load_Portfolio_Widget() {
	register_widget( 'ChillThemes_Widget_Portfolio' );
}
add_action( 'widgets_init', 'ChillThemes_Load_Portfolio_Widget' );

/* Portfolio widget class. */
class ChillThemes_Widget_Portfolio extends WP_Widget {

	/* Set up the widget's unique name, ID, class, description, and other options. */
	function __construct() {

		/* Set up the widget options. */
		$widget_options = array(
			'classname' => 'widget-portfolio',
			'description' => esc_html__( 'Display your site\'s recent portfolio posts.', 'ChillThemes' )
		);

		/* Set up the widget control options. */
		$control_options = array(
			'width' => 200,
			'height' => 350
		);

		/* Create the widget. */
		$this->WP_Widget(
			'chillthemes-portfolio', /* Widget ID. */
			__( 'ChillThemes Portfolio', 'ChillThemes' ), /* Widget name. */
			$widget_options, /* Widget options. */
			$control_options /* Control options. */
		);
	}

	/* Outputs the widget based on the arguments input through the widget controls. */
	function widget( $args, $instance ) {
		extract( $args );

		/* Arguments for the widget. */
		$args['order'] = $instance['order'];
		$args['orderby'] = $instance['orderby'];

		/* Output the theme's $before_widget wrapper. */
		echo $before_widget;

		/* If a title was input by the user, display it. */
		if ( !empty( $instance['title'] ) )
			echo $before_title . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . $after_title;

		/* Query images. */
		$portfolio = new WP_Query(
			array(
				'order' => $args['order'],
				'orderby' => $args['orderby'],
				'posts_per_page' => intval( $instance['limit'] ),
				'post_status' => 'publish',
				'post_type' => 'portfolio'
			)
		);

		if ( $portfolio->have_posts() ) :

			while ( $portfolio->have_posts() ) : $portfolio->the_post();

				if ( has_post_thumbnail() ) : echo '<a href="' . esc_url( get_permalink() ) . '"><img src="' . wp_get_attachment_url( get_post_thumbnail_id(), 'full' ) . '" alt="' . esc_attr( strip_tags( get_the_title() ) ) . '" rel="tipsy" title="' . esc_attr( strip_tags( get_the_title() ) ) . '" /></a>'; endif;

			endwhile;

		endif;

		wp_reset_query();

		/* Close the theme's widget wrapper. */
		echo $after_widget;

	}

	/* Updates the widget control options for the particular instance of the widget. */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance = $new_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['limit'] = strip_tags( $new_instance['limit'] );
		$instance['order'] = $new_instance['order'];
		$instance['orderby'] = $new_instance['orderby'];

		return $instance;
	}

	/* Displays the widget control options in the Widgets admin screen. */
	function form( $instance ) {

		/* Set up the default form values. */
		$defaults = array(
			'title' => 'Portfolio',
			'limit' => apply_filters( 'chillthemes_portfolio_limit', '4' ),
			'order' => 'DESC',
			'orderby' => 'date'
		);

		/* Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults );

		/* Select element options. */
		$order = array( 'ASC' => esc_attr__( 'Ascending', 'ChillThemes' ), 'DESC' => esc_attr__( 'Descending', 'ChillThemes' ) );
		$orderby = array( 'date' => esc_attr__( 'Date', 'ChillThemes' ), 'ID' => esc_attr__( 'ID', 'ChillThemes' ), 'name' => esc_attr__( 'Name', 'ChillThemes' ), 'rand' => esc_attr__( 'Random', 'ChillThemes' ), 'title' => esc_attr__( 'Title', 'ChillThemes' ) );

	?>

		<div class="widget-controls columns-1">

			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'ChillThemes' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" type="text" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Limit:', 'ChillThemes' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo esc_attr( $instance['limit'] ); ?>" type="number" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Order:', 'ChillThemes' ); ?></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>">
					<?php foreach ( $order as $option_value => $option_label ) { ?>
						<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['order'], $option_value ); ?>><?php echo esc_html( $option_label ); ?></option>
					<?php } ?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Order By:', 'ChillThemes' ); ?></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
					<?php foreach ( $orderby as $option_value => $option_label ) { ?>
						<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['orderby'], $option_value ); ?>><?php echo esc_html( $option_label ); ?></option>
					<?php } ?>
				</select>
			</p>

		</div><!-- .widget-controls -->

		<div style="clear: both;">&nbsp;</div>

	<?php } } ?>