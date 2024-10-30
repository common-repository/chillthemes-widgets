<?php

/* Register the Recent Comments widget. */
function ChillThemes_Load_Recent_Comments_Widget() {
	register_widget( 'ChillThemes_Widget_Recent_Comments' );
}
add_action( 'widgets_init', 'ChillThemes_Load_Recent_Comments_Widget' );

/* Recent Comments widget class. */
class ChillThemes_Widget_Recent_Comments extends WP_Widget {

	/* Set up the widget's unique name, ID, class, description, and other options. */
	function __construct() {

		/* Set up the widget options. */
		$widget_options = array(
			'classname' => 'widget-recent-comments',
			'description' => esc_html__( 'Display your site\'s recent comments.', 'ChillThemes' )
		);

		/* Set up the widget control options. */
		$control_options = array(
			'width' => 200,
			'height' => 350
		);

		/* Create the widget. */
		$this->WP_Widget(
			'chillthemes-recent-comments', /* Widget ID. */
			__( 'ChillThemes Recent Comments', 'ChillThemes' ), /* Widget name. */
			$widget_options, /* Widget options. */
			$control_options /* Control options. */
		);
	}

	/* Outputs the widget based on the arguments input through the widget controls. */
	function widget( $args, $instance ) {
		extract( $args );

		/* Output the theme's $before_widget wrapper. */
		echo $before_widget;

		/* If a title was input by the user, display it. */
		if ( !empty( $instance['title'] ) )
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;

		/* Arguments for the widget. */
		$args['limit'] = strip_tags( $instance['limit'] );

		$comments = get_comments(
			apply_filters( 'widget_comments_args',
				array(
					'number' => $instance['limit'],
					'status' => 'approve'
				)
			)
		);

		if ( $comments ) {

			foreach ( (array) $comments as $comment ) {

				if ( get_comment_type( $comment->comment_ID ) == 'comment' ) :

					printf( __( '<a href="%1$s"><img class="avatar" src="http://www.gravatar.com/avatar/%2$s?s=100" alt="%3$s" rel="tipsy" title="%3$s on %4$s" /></a>', 'ChillThemes' ),
						get_comment_link( $comment->comment_ID ),
						md5( strtolower( trim( get_comment_author_email( $comment ) ) ) ),
						esc_attr( get_comment_author( $comment->comment_ID ) ),
						get_the_title( $comment->comment_post_ID )
					);

				endif;

			}

		}

		/* Close the theme's widget wrapper. */
		echo $after_widget;

	}

	/* Updates the widget control options for the particular instance of the widget. */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance = $new_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['limit'] = strip_tags( $new_instance['limit'] );

		return $instance;
	}

	/* Displays the widget control options in the Widgets admin screen. */
	function form( $instance ) {

		/* Set up the default form values. */
		$defaults = array(
			'title' => 'Recent Comments',
			'limit' => apply_filters( 'chillthemes_recent_comments_limit', '4' )
		);

		/* Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults );

	?>

		<div class="widget-controls column-1">

			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'ChillThemes' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" type="text" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Limit:', 'ChillThemes' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo esc_attr( $instance['limit'] ); ?>" type="number" />
			</p>

		</div><!-- .widget-controls -->

		<div style="clear: both;">&nbsp;</div>

	<?php } } ?>