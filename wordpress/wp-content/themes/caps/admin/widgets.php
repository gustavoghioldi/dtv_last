<?php
/**
 * Registers our main widget area and the front page widget areas.
 *
 */
function caps_widgets_init() {	
	register_sidebar( array(
		'name' => __( 'Main Sidebar', THEMENAME ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on blog page and single blog page', THEMENAME ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="title"><span>',
		'after_title' => '</span></h3>',
	) );

	$top_sliding_panel = ot_get_option('top_sliding_panel', 'on');
	if($top_sliding_panel == 'on'){
		register_sidebar( array(
			'name' => __( 'Top sliding panel  Sidebar', THEMENAME ),
			'id' => 'top-panel',
			'description' => __( 'Appears only on Front page', THEMENAME ),
			'before_widget' => '<div id="%1$s" class="topbar-widget %2$s front-page-sidebar">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		) );
	}

	register_sidebar( array(
		'name' => __( 'Front-page  Sidebar', THEMENAME ),
		'id' => 'sidebar-front',
		'description' => __( 'Appears only on Front page', THEMENAME ),
		'before_widget' => '<div id="%1$s" class="widget %2$s front-page-sidebar">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="title"><span>',
		'after_title' => '</span></h3>',
	) );
	

	$widgets = ot_get_option( 'custom_sidebar', array() );	
	if(!empty($widgets)){
		foreach( $widgets as $widget ){
			$id = ( $widget['id'] != '' )? $widget['id'] : sanitize_title('', '-', $widget['title']);
			register_sidebar( array(
				'name' =>  $widget['title'],
				'id' => $id,
				'description' => $widget['desc'],
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="title"><span>',
				'after_title' => '</span></h3>',
			) );
		}
	}
	
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 1', THEMENAME ),
		'id' => 'footer-1',
		'description' => __( 'Appears in Footer first', THEMENAME ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="title"><span>',
		'after_title' => '</span></h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 2', THEMENAME ),
		'id' => 'footer-2',
		'description' => __( 'Appears in Footer second', THEMENAME ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="title"><span>',
		'after_title' => '</span></h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 3', THEMENAME ),
		'id' => 'footer-3',
		'description' => __( 'Appears in Footer third', THEMENAME ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="title"><span>',
		'after_title' => '</span></h3>',
	) );
		
}
add_action( 'widgets_init', 'caps_widgets_init' );
?>