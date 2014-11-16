<?php
class Caps_posts_slider_widget extends WP_Widget {
	// construct the widget
	public function __construct() {
		parent::__construct(
 		'caps_posts_slider_widget', // Base ID
		'Caps Posts Slider', // Name
		array( 'description' => __( 'Caps Posts slider, you can customize this slider from theme option', THEMENAME ), ) // Args
	);
	}

	// extract required arguments and run the shortcode
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		

		echo $before_widget;
		if (!empty($title))
		echo $before_title . $title . $after_title;

			get_template_part('inc/posts-slider', '');
			
		
		
		echo $after_widget;
	}

	public function form( $instance ) {
		
		if ( isset( $instance[ 'title' ] ) ) {
		
			$title = $instance[ 'title' ];
		} else {
		
		$title = __( '', THEMENAME );
		}
		
	
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

}

// add caps to available widgets
add_action( 'widgets_init', create_function( '', 'register_widget( "Caps_posts_slider_widget" );' ) );
?>