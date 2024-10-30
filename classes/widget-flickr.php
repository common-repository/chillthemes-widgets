<?php

/* Register the Flickr widget. */
function ChillThemes_Load_Flickr_Widget() {
	register_widget( 'ChillThemes_Widget_Flickr' );
}
add_action( 'widgets_init', 'ChillThemes_Load_Flickr_Widget' );

/* Flickr widget class. */
class ChillThemes_Widget_Flickr extends WP_Widget {

	/* Set up the widget's unique name, ID, class, description, and other options. */
	function __construct() {

		/* Set up the widget options. */
		$widget_options = array(
			'classname' => 'widget-flickr',
			'description' => esc_html__( 'Display your Flickr images on your site.', 'ChillThemes' )
		);

		/* Set up the widget control options. */
		$control_options = array(
			'width' => 200,
			'height' => 350
		);

		/* Create the widget. */
		$this->WP_Widget(
			'chillthemes-flickr', /* Widget ID. */
			__( 'ChillThemes Flickr', 'ChillThemes' ), /* Widget name. */
			$widget_options, /* Widget options. */
			$control_options /* Control options. */
		);
	}

	/* Outputs the widget based on the arguments input through the widget controls. */
	function widget( $args, $instance ) {
		extract( $args );

		global $image_count;

		/* Arguments for the widget. */
		$args['id'] = strip_tags( $instance['id'] );
		$args['limit'] = strip_tags( $instance['limit'] );

		/* Output the theme's $before_widget wrapper. */
		echo $before_widget;

		/* If a title was input by the user, display it. */
		if ( !empty( $instance['title'] ) )
			echo $before_title . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . $after_title;

		if ( $args['id'] != '' ) {
			$images = array();
			$regx = "/<img(.+)\/>/";

			$rss_url = 'http://api.flickr.com/services/feeds/photos_public.gne?ids=' . $args['id'] . '&lang=en-us&format=rss_200';
			$flickr_feed = simplexml_load_file( $rss_url );

			foreach ( $flickr_feed->channel->item as $item ) {
				preg_match ( $regx, $item->description, $matches );
				$images[] = array(							  
					'link' => $item->link,
					'thumb' => $matches[0]
				);
			}

			foreach ( $images as $img ) {
				if ( $image_count < $args['limit'] ) {
					$img_tag = str_replace( '_m', '_b', $img['thumb'] );
					echo '<a href="' . $img['link'] . '">' . $img_tag . '</a>';
					$image_count++;
				}
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
		$instance['id'] = $new_instance['id'];
		$instance['limit'] = strip_tags( $new_instance['limit'] );

		return $instance;
	}

	/* Displays the widget control options in the Widgets admin screen. */
	function form( $instance ) {

		/* Set up the default form values. */
		$defaults = array(
			'title' => 'Flickr',
			'id' => '37451064@N00',
			'limit' => apply_filters( 'chillthemes_flickr_limit', '4' )
		);

		/* Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults );

		/* Select element options. */
		$display = array( 'latest' => esc_attr__( 'Latest', 'ChillThemes' ), 'random' => esc_attr__( 'Random', 'ChillThemes' ) );

	?>

		<div class="widget-controls">

			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'ChillThemes' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" type="text" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e( 'ID:', 'ChillThemes' ); ?></label>
				<span style="float: right;"><a href="http://idgettr.com" target="_blank">Get Your Flickr ID</a></span>
				<input class="widefat" id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php echo esc_attr( $instance['id'] ); ?>" type="text" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Limit:', 'ChillThemes' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo esc_attr( $instance['limit'] ); ?>" type="number" />
			</p>

		</div><!-- .widget-controls -->

		<div style="clear: both;">&nbsp;</div>

	<?php } } ?>