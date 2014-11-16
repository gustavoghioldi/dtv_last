<?php
/**
 * Trend functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 */

//Define variable
define('THEMENAME', 'caps' );
define('THEMEVERSION', '1.0.0' );
define('THEMEURI', trailingslashit( get_template_directory_uri() ) );
define('THEMEDIR', trailingslashit( get_template_directory() ) );


 /**
 * Required: set 'ot_theme_mode' filter to true.bread
 */
 add_filter( 'ot_theme_mode', '__return_true' );

 /**
 * Required: include OptionTree.
 */
 load_template( THEMEDIR . 'option-tree/ot-loader.php' );


 /**
 * Theme Options
 */
 load_template( THEMEDIR . 'admin/theme-options.php' );


  if(!class_exists('Shortcodes_Ultimate')) {
	load_template( THEMEDIR . 'inc/shortcodes-ultimate/shortcodes-ultimate.php' );	
 }


if ( ! function_exists( 'caps_setup' ) ) :
/**
 * trend setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 */
function caps_setup() {

	define('LEL',  ot_get_option('list_excerpt_length', 20));
	define('LBEL', ot_get_option('large_excerpt_length', 30) );	
	define('LOADER', THEMEURI.'images/loader.gif');

	if ( ! isset( $content_width ) ) $content_width = 1180;

	/*
	 * Make Twenty Fourteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Fourteen, use a find and
	 * replace to change THEMESNAME to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( THEMENAME, THEMEDIR . '/langs' );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css' ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	
	
	
	register_nav_menu( 'header', __( 'Main Menu', THEMENAME ) );	
	register_nav_menu( 'footer', __( 'Footer Menu', THEMENAME ) );	

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	add_theme_support( 'woocommerce' );
}
endif; // caps_setup
add_action( 'after_setup_theme', 'caps_setup' );

 /*
 * activation for all required and recommanded plugins
 */
 load_template( THEMEDIR . 'lib/plugins.php' );

 /**
 * image resize function
 *
 */
load_template( THEMEDIR . 'admin/mr-image-resize.php' );

 /**
 * Admin function
 *
 */
require THEMEDIR . 'admin/functions.php';

 /**
 * Metabox function
 *
 */
require THEMEDIR . 'admin/meta-box-posts.php';

/**
 * Register widget areas.
 *
 */
require THEMEDIR . 'admin/widgets.php';

/**
 * Enqueue scripts and styles for the front end.
 *
 */
require THEMEDIR . 'inc/scripts.php';
/**
 * Add cool megamenu.
 *
 */
load_template( THEMEDIR . 'inc/caps-mega-menu/caps-mega-menu.php' );

/**
 * Function for the front end.
 *
 */
require THEMEDIR . 'inc/functions.php';

load_template( THEMEDIR . 'inc/popular-widget/popular-widget.php' );  
load_template( THEMEDIR . 'inc/caps-share-buttons/caps-share-buttons.php' ); 
load_template( THEMEDIR . 'inc/facebook-like-box/facebook_like_box.php' );
load_template( THEMEDIR . 'inc/breadcrumbs.php' );
load_template( THEMEDIR . 'inc/caps-review/caps-review.php' );
load_template( THEMEDIR . 'siteorigin-panels/siteorigin-panels.php' );

?>