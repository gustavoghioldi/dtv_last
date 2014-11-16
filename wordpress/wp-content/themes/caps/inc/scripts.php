<?php
function caps_scripts_styles(){
      global $wp_styles;

     
	
    //wp_register_style( 'caps-google', 'http://fonts.googleapis.com/css?family=PT+Sans' );    
   // wp_enqueue_style('caps-google');
	wp_register_style( 'bootstrap', THEMEURI . 'css/bootstrap.css', array(), THEMENAME );
     wp_register_style('caps-bootstrap-rtl', THEMEURI . 'css/bootstrap-rtl.css');
    wp_enqueue_style('bootstrap');  
    if(is_rtl()){
        wp_enqueue_style('caps-bootstrap-rtl');
    }  

             
	wp_enqueue_style( 'megamenu-css', THEMEURI . 'css/megamenu.css' );
	wp_register_style('caps-animated', THEMEURI . 'css/animated.css');
	wp_register_style('caps-animate', THEMEURI . 'css/animate.min.css');
    wp_enqueue_style('caps-events', THEMEURI . 'css/events.css');
    wp_enqueue_style('caps-transitions', THEMEURI .'css/owl.transitions.css');
    wp_enqueue_style('caps-genericons', THEMEURI .'fonts/genericons/genericons.css');

    su_query_asset( 'css', 'magnific-popup' );
    su_query_asset( 'css','owl-carousel');
	
	if ( !wp_is_mobile() ) {
		wp_enqueue_style('caps-animate');
		wp_enqueue_style('caps-animated');
	}
    
    wp_register_style( 'font-awesome', THEMEURI .'fonts/font-awesome/css/font-awesome.css' );
    wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'font-awesome-4.0.3', THEMEURI .'fonts/font-awesome-4.0.3/css/font-awesome.css' );
    wp_enqueue_style( 'dashicons' ); 
    // Add the styles first, in the <head> (last parameter false, true = bottom of page!)
    wp_enqueue_style('qtip', THEMEURI .'css/jquery.qtip.css' );  
     wp_enqueue_style('slide.css',THEMEURI.'css/slide.css');
     wp_enqueue_style('selectbox.css',THEMEURI.'css/jquery.selectbox.css');

    wp_enqueue_style( 'caps-style', get_stylesheet_uri() );

    wp_enqueue_style( 'caps-custom', THEMEURI .'css/custom.css' );
	
	wp_register_style( 'caps-responsive', THEMEURI .'css/responsive.css' );
    wp_enqueue_style( 'caps-responsive' );

    /*
     * Loads the Internet Explorer specific stylesheet.
     */
    wp_enqueue_style( 'caps-ie', THEMEURI .'css/ie.css', array( 'caps-style' ), '20121010' );
    $wp_styles->add_data( 'caps-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'caps_scripts_styles' );

/**
 * Enqueues scripts for front-end.
 *
 */
function caps_scripts_js() {
    global $wp_styles;

    /*
     * Adds JavaScript to pages with the comment form to support
     * sites with threaded comments (when in use).
     */
    wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-core' );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    
	/*
     * Adds JavaScript load in Header.
     */ 
    wp_register_script( 'caps-bootstrap', THEMEURI .'js/bootstrap.min.js', array('jquery'), '1.0.0' );    
    wp_enqueue_script('caps-bootstrap');
    wp_register_script('caps-holder', THEMEURI .'js/holder.js', array('jquery'), '2.0');
    wp_enqueue_script('caps-holder');

    wp_enqueue_script('caps-bxslider', THEMEURI .'js/jquery.ticker.min.js', array('jquery'), '4.1.2');
    wp_enqueue_script('slide.js', THEMEURI.'js/slide.js', array('jquery') );
    wp_enqueue_script('jquery.selectbox', THEMEURI.'js/jquery.selectbox-0.2.min.js', array('jquery') );

    
    // Not using imagesLoaded? :( Okay... then this.
   // wp_enqueue_script('caps-qtip', THEMEURI .'js/jquery.qtip.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('caps-lazy', THEMEURI .'js/jquery.lazy.min.js', array('jquery'), '1.0', true);

    $scrolling_animation = ot_get_option('scrolling_animation');
    //if( $scrolling_animation == 'enable'):
    wp_enqueue_script( 'caps-scroll-effect', THEMEURI .'js/scroll-effect.js', array('jquery'), '1.0', true );
   // endif;

   
    su_query_asset( 'js', 'jquery' );
    su_query_asset( 'js', 'magnific-popup' );
    su_query_asset( 'js', 'su-other-shortcodes' );
    su_query_asset( 'js','owl-carousel');

    wp_register_script( 'caps-js', THEMEURI .'js/scripts.js', array('jquery', 'jquery-ui-core'), '1.0', true ); 
    wp_enqueue_script('caps-js');

    wp_enqueue_script( 'caps-retina', THEMEURI .'js/retina.min.js', array('jquery', 'jquery-ui-core'), '1.3.0', true );
	
}
add_action( 'wp_enqueue_scripts', 'caps_scripts_js' );

add_action( 'wp_print_scripts', 'caps_inline_js' );
function caps_inline_js(){
		global $wpdb;
		$top_fixed_menu = ot_get_option('top_fixed_menu');
		if( $top_fixed_menu == 'on') $top_fixed = 1; else $top_fixed = 0;
		echo "<script type='text/javascript'>\n";
		echo "var top_fixed_menu = ".$top_fixed."; \n";
		echo "</script>";
}



function caps_template_file_load_to_footer(){
	load_template( THEMEDIR . 'inc/preset.php' );
	load_template( THEMEDIR . 'inc/style.php' );
    wp_enqueue_script( 'megamenu-js', THEMEURI.'js/megamenu.js', array('jquery') );
	
}
add_action( 'wp_head', 'caps_template_file_load_to_footer' );

function caps_fabicon_ico(){
    do_action( 'caps_fabicon_ico' );
}
add_action( 'caps_fabicon_ico', 'caps_fabicon_ico_callback' );

if( !function_exists( 'caps_fabicon_ico_callback' ) ){
    function caps_fabicon_ico_callback(){
        global $wpdb;

        echo '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="'.ot_get_option('apple_ipad_retina_icon', THEMEURI .'images/favicon.png').'">';
        echo '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="'.ot_get_option('apple_iphone_retina_icon', THEMEURI .'images/favicon.png').'">';
        echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="'.ot_get_option('apple_ipad_icon', THEMEURI .'images/favicon.png').'">';
        echo '<link rel="apple-touch-icon-precomposed " href="'.ot_get_option('apple_iphone_icon', THEMEURI .'images/favicon.png').'">';
        echo '<link rel="shortcut icon" href="'.ot_get_option('custom_fabicon', THEMEURI .'images/favicon.ico').'">';
    }
} 
?>