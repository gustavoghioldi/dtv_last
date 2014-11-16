<?php
// Define plugin file constants
define( 'SU_PLUGIN_FILE', 'shortcodes-ultimate.php' );
define( 'SU_PLUGIN_VERSION', '4.7.0' );
define( 'SU_ENABLE_CACHE', true );

define( 'shortcodepath', THEMEURI.'inc/shortcodes-ultimate' );
define( 'shortcodedir', THEMEDIR . 'inc/shortcodes-ultimate' );




// Includes
require_once 'inc/vendor/sunrise.php';
require_once 'inc/core/admin-views.php';
require_once 'inc/core/requirements.php';
require_once 'inc/core/load.php';
require_once 'inc/core/assets.php';
require_once 'inc/core/shortcodes.php';
require_once 'inc/core/tools.php';
require_once 'inc/core/data.php';
require_once 'inc/core/generator-views.php';
require_once 'inc/core/generator.php';
require_once 'inc/core/widget.php';
require_once 'inc/core/counters.php';

function caps_su_url($ext, $filename){
	return shortcodepath.'/'.$ext;
}

function caps_su_dir_path($file){
	return  THEMEDIR . 'inc/shortcodes-ultimate';
}
