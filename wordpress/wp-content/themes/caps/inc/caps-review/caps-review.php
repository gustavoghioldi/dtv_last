<?php
/**
 * @since     1.0
 * @copyright Copyright (c) 2013, MyThemesShop
 * @author    themecap
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/* Sets the custom db table name. */
define( 'MTS_CAPS_REVIEW_DB_TABLE', 'mts_caps_reviews' );
	
/* Sets the path to the plugin directory. */
define( 'CAPS_REVIEW_DIR', THEMEDIR.'inc/caps-review/' );

/* Sets the path to the plugin directory URI. */
define( 'CAPS_REVIEW_URI', THEMEURI.'inc/caps-review/' );

/* Sets the path to the `admin` directory. */
define( 'CAPS_REVIEW_ADMIN', CAPS_REVIEW_DIR . trailingslashit( 'admin' ) );

/* Sets the path to the `includes` directory. */
define( 'CAPS_REVIEW_INCLUDES', CAPS_REVIEW_DIR . trailingslashit( 'includes' ) );

/* Sets the path to the `assets` directory. */
define( 'CAPS_REVIEW_ASSETS', CAPS_REVIEW_URI . trailingslashit( 'assets' ) );


/* Internationalize the text strings used. */
add_action( 'init', 'caps_review_i18n', 1 );

/* Loads libraries. */
add_action( 'init', 'caps_review_includes_libraries', 2 );

add_action( 'init', 'caps_review_activation', 3 );


/**
 * Internationalize the text strings used.
 *
 * @since 1.0
 */
function caps_review_i18n() {
	load_plugin_textdomain( 'wp-review', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

/**
 * Loads the initial files needed by the plugin.
 *
 * @since 1.0
 */
function caps_review_includes_libraries() {

	/* Loads the admin functions. */
	require_once( CAPS_REVIEW_ADMIN . 'admin.php' );

	/* Loads the meta boxes. */
	require_once( CAPS_REVIEW_ADMIN . 'metaboxes.php' );

	/* Loads the front-end functions. */	
	require_once( CAPS_REVIEW_INCLUDES . 'functions.php' );

	

	/* Loads the enqueue functions. */
	require_once( CAPS_REVIEW_INCLUDES . 'enqueue.php' );

}

/* Loads the widget. */	
require_once( CAPS_REVIEW_INCLUDES . 'widget.php' );

function caps_review_activation(){
    /* Loads activation functions */
    //require_once( CAPS_REVIEW_DIR . '/includes/functions.php' );
	require_once( CAPS_REVIEW_DIR . '/admin/activation.php' );
}
?>