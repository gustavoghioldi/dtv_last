<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'admin123456');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'n)dia<5(fH-~7hb9fmGwHka)/ |}_~H7E4ODZ&uNYNeT^bqq*r=}@fB.R|uo@$aR');
define('SECURE_AUTH_KEY',  '!#Rh~/edZ@Y}c1b>r]H~&FPmISsEOM3H.u-~Q.pxlNj/r|g~PqFKCZ*-J%erE[|3');
define('LOGGED_IN_KEY',    '|xF(_PftXy+6+g:uv#,K^OeC %8-_HsN leU^n{}lJtA l2-G[d+i?yTL7] N,LD');
define('NONCE_KEY',        'A/5<BN;y)Si11-V+v<$mifUgJH9+ON:2ORC2G.)~,Vrr%5:K/=uToC6H-TPR1d9+');
define('AUTH_SALT',        'me<K,`*$ 3x5(IUv|;r&tIN=YRuW<.wh!lw+PM4+$Y$R=nUWd.5v-A.A|-=dPx-1');
define('SECURE_AUTH_SALT', '!Q?07x+!|V&k;5)._UZy^B^zM`,Tvs;XNKYtj_9*WC2y)Kd/%xeVQo(CQ{Y{}1:3');
define('LOGGED_IN_SALT',   'I@~`)SMhS$a|f0=A&I$mG*B2D1Jq8}$,:DK%g>8bI4$ImiV-p}F3-zn}:L$]6I>;');
define('NONCE_SALT',       'fCOaY5ruaR;L{ASS&z_-01F`+nvL+J|PXJL.+58-VhhhKV.-<K=*nUiMysJeU9:n');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
