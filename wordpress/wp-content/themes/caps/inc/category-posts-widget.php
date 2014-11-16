<?php
// widget class
class Caps_posts_category_widget extends WP_Widget {

	// construct the widget
	public function __construct() {
		parent::__construct(
 		'caps_posts_category_posts_widget', // Base ID
		'Caps category Posts', // Name
		array( 'description' => __( 'Recent posts of same category, on single post pages', THEMENAME ), ) // Args
	);
	}

	// extract required arguments and run the shortcode
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		if(is_singular('post')){
		echo $before_widget;
		if (!empty($title))
		echo $before_title . $title . $after_title;
		
			?>
		        <?php global $post; $categories = get_the_category();  ?> 
		        <ul> 
		        <?php $posts = get_posts('numberposts=10&category='. $categories[0]->term_id); foreach($posts as $post) : ?> 
		        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li> 
		        <?php endforeach; ?> 
		         
		        <li>View the full archive for<a href="<?php echo get_category_link($categories[0]->term_id);?>" title="View all posts filed under <?php echo $categories[0]->name; ?>"> <?php echo $categories[0]->name; ?> &raquo;</a></li> 
		       
		    </ul> 
			<?php 

		echo $after_widget;
		} 
	}

	public function form( $instance ) {
		
		if ( isset( $instance[ 'title' ] ) ) {
		
			$title = $instance[ 'title' ];
		} else {
		
		$title = __( 'Previous posts', THEMENAME );
		}
		
		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
		# URL
		
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

}

// add caps to available widgets
add_action( 'widgets_init', create_function( '', 'register_widget( "Caps_posts_category_widget" );' ) );
?>