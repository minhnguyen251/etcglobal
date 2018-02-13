<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'etcglobal');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '(>j~T4x@YJ?w@y6w?(dw7kpaS`7L rLMNDU}C~}nW3FBS<0`?jNW}_ ;gb4[%8HD');
define('SECURE_AUTH_KEY',  'ySCq-<uaIMok^-,$CWi(wEl]w9WMXDwenQ;hZZ^gh,cIt=0)n`TtUqy6vd}a[y-S');
define('LOGGED_IN_KEY',    'Lyfp]-A~l} QpmGe8pKk1QjPYr1HcV$1&0N0Rx<ZR@u9W$}N>+663_eH7l},*gY9');
define('NONCE_KEY',        '#({JZ105YC>k]*H5BHMU+fwzWD)9!Rb3vx6VEqSu>]^|Q fDkDeL0D_!er^h6<I!');
define('AUTH_SALT',        'fjBbzPkBdhDd{(V`c}{WbM{?T?5!]7Ud!QZ6|hsxZfKID8*SzQTTP8&ZYS@2lb]Z');
define('SECURE_AUTH_SALT', '}8{zbs[_M!t6aoz#F3iZW5HZYob^2u0{,! >(D-G!s,b`p1&T d&H0AE;wG~WSgY');
define('LOGGED_IN_SALT',   'sLr%B1hT-yDe{nFfSSMr|(=>[k)ZiniqlwX9,{}|iRPJ6ScTkoA/>6AIW|/ -D!M');
define('NONCE_SALT',       '*W_^DprKvLi9Er:~fA[,2P}BQ`]6MyPdf7x?hLK%%sT4<|s]iHXq| !r>,BFn;b5');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
