<?php 

	if ( !defined('WP_CONTENT_URL') ) {
		define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
	}
	if ( ! defined( 'WP_PLUGIN_URL' ) ) {
		  define( 'WP_PLUGIN_URL', THEMEURI.'inc' );
	}
	$wp_popular_widget_url = 'popular-widget';
	$wp_popular_widget_path = THEMEURI.'inc/popular-widget';
	
	if( !defined( 'ABSPATH' ) ) 
		die( );
	
	if( ! class_exists( 'PopularWidget' )
	&& ! class_exists( 'PopularWidgetFunctions' ) 
	&& file_exists( dirname( __FILE__ ) . "/_inc/functions.php" ) ){
		
	load_template( dirname( __FILE__ ) . "/_inc/functions.php" );
	
	class PopularWidget extends PopularWidgetFunctions {
		
		public $tabs = array();
		public $defaults = array();
		public $version = "1.6.6";
		public $current_tab = false;
		
		/**
		 * Constructor
		 *
		 * @return void
		 * @since 0.5.0
		 */
		function PopularWidget( ){
			
			$this->load_text_domain( );
			$this->PopularWidgetFunctions( ); 
			
			$this->WP_Widget( 'popular-widget', __( 'Caps Popular Widget', 'pop-wid' ), 
				array( 'classname' => 'popular-widget', 'description' => __( "Display most popular posts and tags", 'pop-wid' ) ) 
			);
			
			if(!defined('POPWIDGET_FOLDER')){
				define( 'POPWIDGET_FOLDER', 'popular-widget' );
			}
			if(!defined('POPWIDGET_ABSPATH')){
				define( 'POPWIDGET_ABSPATH', str_replace("\\","/", dirname( __FILE__ ) ) );
			}
			if(!defined('POPWIDGET_URL')){
				define( 'POPWIDGET_URL', WP_PLUGIN_URL . "/" . 'popular-widget' . "/" );
			}		
			
			
			$this->defaults = apply_filters( 'pop_defaults_settings', array(
				'nocomments' => false, 'nocommented' => false, 'noviewed' => false, 'norecent' => false, 
				'userids' => false, 'imgsize' => 'thumbnail', 'counter' => false, 'excerptlength' => 15, 'tlength' => 20,
				'meta_key' => '_popular_views', 'calculate' => 'visits', 'title' => '', 'limit'=> 5, 'cats'=>'', 'lastdays' => 90,
				'taxonomy' => 'post_tag', 'exclude_users' => false, 'posttypes' => array( 'post' => 'on' ), 'thumb' => false,
				'excerpt' => false, 'notags'=> false, 'exclude_cats' => false
			) );
			
			$this->tabs = apply_filters( 'pop_defaults_tabs', array(
				 'recent' =>  __( 'Recent', 'pop-wid' ) ,
				 'viewed' => __( 'Popular', 'pop-wid' ), 
				 'commented' => __( 'Comment', 'pop-wid' ) 
				 
			 ) );
			 
		}
		
		/**
		 * Display widget.
		 *
		 * @param array $args
		 * @param array $instance
		 * @return void
		 * @since 0.5.0
		 */
		function widget( $args, $instance ) {
			if( file_exists( POPWIDGET_ABSPATH . '/_inc/widget.php' ) )
				include( POPWIDGET_ABSPATH . '/_inc/widget.php'  );
		}
		
		/**
		 * Configuration form.
		 *
		 * @param array $instance
		 * @return void
		 * @since 0.5.0
		 */
		function form( $instance ) {
			if( file_exists( POPWIDGET_ABSPATH . '/_inc/form.php' ) )
				include( POPWIDGET_ABSPATH . '/_inc/form.php' );
		}
		
		/**
		 * Display widget.
		 *
		 * @param array $instance
		 * @return array
		 * @since 1.5.6
		 */
		function update( $new_instance, $old_instance ){
			foreach( $new_instance as $key => $val ){
				if( is_array( $val ) )
					$new_instance[$key] = $val;
					
				elseif( in_array( $key, array( 'lastdays', 'limit', 'tlength', 'excerptlength' ) ) )			
					$new_instance[$key] = intval( $val );
					
				elseif( in_array( $key,array( 'calculate', 'imgsize', 'cats', 'userids', 'title', 'meta_key' ) ) )	
					$new_instance[$key] = trim( $val,',' );	
			}
			
			if( empty($new_instance['meta_key'] ) )
				$new_instance['meta_key'] = $this->defaults['meta_key'];
				
			return $new_instance;
		}
	}
	
	// do that thing you do!
	add_action( 'widgets_init' , create_function( '', 'return register_widget("PopularWidget");' ) );
	
	}//end if
