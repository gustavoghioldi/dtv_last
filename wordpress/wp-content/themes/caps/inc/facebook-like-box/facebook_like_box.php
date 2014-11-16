<?php
add_action('admin_init', 'caps_flb_scripts');
add_action('wp_enqueue_scripts', 'caps_flb_scripts');

add_action("init", "caps_fb_like_init");
add_shortcode("caps_facebook_like_box", "caps_facebook_like_box_sc");
add_shortcode("caps_facebook_posts_like", "caps_facebook_posts_like_sc");

function caps_flb_scripts(){
	wp_enqueue_style('cfblbcss', THEMEURI.'inc/facebook-like-box/facebook.css');
	wp_enqueue_script('cfblbjs', THEMEURI.'inc/facebook-like-box/facebook.js', array('jquery'));
}

//The following function will retrieve all the avaialable 
//options from the wordpress database

function caps_retrieve_options(){
	global $wpdb;
	
	$opt_val = array( 
			'fb_border_color' => '#E9E9E9',
			'width' => 350,
			'height' => 296,
			'color_scheme' => 'light',
			'show_faces' => 'true',
			'stream' => 'false',
			'header' => 'false',
	); 
	return $opt_val;
}

class Facebook_like_box_widget extends WP_Widget {

	// construct the widget
	public function __construct() {
		parent::__construct(
 		'caps_facebook_widget', // Base ID
		'Caps Facebook like box', // Name
		array( 'description' => __( 'Facebook like box widget', 'capstheme' ), ) // Args
	);
	}

	public function widget( $args, $instance ){
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$url = isset($instance['url'])? $instance['url'] : '';

		$iframe = 'iframe';
		$option_value = caps_retrieve_options();
		$option_value['fb_url'] = str_replace(":", "%3A", $url);
		$option_value['fb_url'] = str_replace("/", "%2F", $option_value['fb_url']);
		extract($args);
	        
		echo $before_widget;
		if (!empty($title))
		echo $before_title . $title . $after_title;

		?><div class="facebook-wrap"><div class="facebook-container" style="width:<?php echo $option_value['width'];?>px;height:<?php echo $option_value['height'];?>px">
		<<?php echo $iframe; ?> 
		src="//www.facebook.com/plugins/likebox.php?href=<?php echo $option_value['fb_url'];?>&amp;width=<?php echo $option_value['width'];?>&amp;height=<?php echo $option_value['height'];?>&amp;colorscheme=<?php echo $option_value['color_scheme'];?>&amp;show_faces=<?php echo $option_value['show_faces'];?>&amp;stream=<?php echo $option_value['stream'];?>&amp;header=<?php echo $option_value['header'];?>&amp;border_color=%23<?php echo str_replace("#","",$option_value['fb_border_color']);?>" 
	        style="border:1px solid <?php echo $option_value['fb_border_color'];?>; overflow:hidden; width:<?php echo $option_value['width'];?>px; height:<?php echo $option_value['height'];?>px;">
		</<?php echo $iframe; ?>>
		</div></div>
	<?php		
		echo $after_widget;
	}

	public function form( $instance ) {
		
		if ( isset( $instance[ 'title' ] ) ) {
		
			$title = $instance[ 'title' ];
		} else {
		
		$title = __( 'Facebook Likes', THEMENAME );
		}

		

		$url = isset($instance['url'])? esc_url( $instance['url'] ) : 'https://www.facebook.com/envato';
	
		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
		# URL
		echo '<p><label for="' . $this->get_field_id('url') . '">' . 'Facebook:' . '</label><input class="widefat" id="' . $this->get_field_id('url') . '" name="' . $this->get_field_name('url') . '" type="text" value="' . $url . '" /></p>';
		
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['url'] = strip_tags( $new_instance['url'] );

		return $instance;
	}
}
add_action( 'widgets_init', create_function( '', 'register_widget( "Facebook_like_box_widget" );' ) );

function caps_facebook_like_box_sc($atts){
    ob_start();

    $settings = settings_api_field_value();
	$option_value = $settings['facebook_like_box'];

    
    $atts['fb_url'] = str_replace(":", "%3A", $atts['fb_url']);
    $atts['fb_url'] = str_replace("/", "%2F", $atts['fb_url']);
    
    if(isset($atts['width']) && !empty($atts['width'])) $option_value['width'] = $atts['width'];
    if(isset($atts['height']) && !empty($atts['height'])) $option_value['height'] = $atts['height'];
    $iframe = 'iframe';
    ?>
    
    <<?php echo $iframe; ?> 
    src="//www.facebook.com/plugins/likebox.php?href=<?php echo $option_value['fb_url'];?>&amp;
    width=<?php echo $option_value['flb_width'];?>&amp;
    height=<?php echo $option_value['flb_height'];?>&amp;
    colorscheme=<?php echo $option_value['flb_color_scheme'];?>&amp;
    show_faces=<?php echo $option_value['flb_show_faces'];?>&amp;
    stream=<?php echo $option_value['flb_stream'];?>&amp;
    header=<?php echo $option_value['flb_header'];?>&amp;
    border_color=%23<?php echo str_replace("#","",$option_value['fb_border_color']);?>"
    scrolling="no" 
    frameborder="0" 
    style="border:1px solid <?php echo $option_value['fb_border_color'];?>; overflow:hidden; width:<?php echo $option_value['width'];?>px; height:<?php echo $option_value['height'];?>px;">
    </<?php echo $iframe; ?>>
	
<?php
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
}


function fb_like_button_for_post($content) {

	

	$cfpl_enable = ot_get_option('fplb_enable');
	$show_button = 'after_post_content';
	$layout = 'standard';
	$show_faces = 'true';
	$verb = 'like';
	$color_scheme = 'light';
	$iframe = 'iframe';
	global $post;
	if (is_single()) { 
		if($cfpl_enable == 'on'){
			if($show_button == 'before_post_content'){
				$content = '<'.$iframe.' src="http://www.facebook.com/plugins/like.php?href='
					.urlencode(get_permalink($post->ID)).
					'&amp;layout='.$layout.'&amp;show_faces='.$show_faces.'&amp;width=450&amp;action='.$verb.'&amp;colorscheme='.$color_scheme.'" style="border:none; overflow:hidden; width:450px; height:60px;"></'.$iframe.'>'
					.$content;
			}
			if($show_button == 'after_post_content'){
				$content = $content.'<'.$iframe.' src="http://www.facebook.com/plugins/like.php?href='
					.urlencode(get_permalink($post->ID)).
					'&amp;layout='.$layout.'&amp;show_faces='.$show_faces.'&amp;width=450&amp;action='.$verb.'&amp;colorscheme='.$color_scheme.'" style="border:none; overflow:hidden; width:450px; height:60px;"></'.$iframe.'>';
			}
			if($show_button == 'before_after_post_content'){
				$content = '<'.$iframe.' src="http://www.facebook.com/plugins/like.php?href='
					.urlencode(get_permalink($post->ID)).
					'&amp;layout='.$layout.'&amp;show_faces='.$show_faces.'&amp;width=450&amp;action='.$verb.'&amp;colorscheme='.$color_scheme.'" style="border:none; overflow:hidden; width:450px; height:60px;"></'.$iframe.'>'
					.$content.
					'<'.$iframe.' src="http://www.facebook.com/plugins/like.php?href='
					.urlencode(get_permalink($post->ID)).
					'&amp;layout='.$layout.'&amp;show_faces='.$show_faces.'&amp;width=450&amp;action='.$verb.'&amp;colorscheme='.$color_scheme.'" style="border:none; overflow:hidden; width:450px; height:60px;"></'.$iframe.'>';
			}
		}
	}
	return $content;
}
add_filter('the_content', 'fb_like_button_for_post');

function caps_facebook_posts_like_sc($content){
    $cfpl_enable = ot_get_option('fplb_enable');
	$show_button = 'after_post_content';
	$layout = 'standard';
	$show_faces = 'true';
	$verb = 'Recommend';
	$color_scheme = 'light';
	$iframe = 'iframe';

	if (is_single()) { 
		$content = 'mmmmmmmmmmmmmm<'.$iframe.' src="http://www.facebook.com/plugins/like.php?href='
				.urlencode(get_permalink($post->ID)).
				'&amp;layout='.$layout.'&amp;show_faces='.$show_faces.'&amp;width=450&amp;action='.$verb.'&amp;colorscheme='.$color_scheme.'" style="border:none; overflow:hidden; width:450px; height:60px;"></'.$iframe.'>'
				.$content;
	}
	return $content;
}

function caps_fb_like_init(){
	load_plugin_textdomain('capstheme', false, THEMEDIR.'inc/facebook-like-box/languages');	
}
?>
