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
define('DB_NAME', 'artfill');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'toor');

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
define('AUTH_KEY',         '>S:NPukkU|A-XMEPm;=a->zw5.TIK7;/R^QM^ZyU~04c_b.1|!$i$rt2wHw^D_9L');
define('SECURE_AUTH_KEY',  'D?qOkcT[pb)OY~+t8|M4){S6*D2>RqobQ|YemkZ4T< W_  pRAxqX`^^.UiLm/#4');
define('LOGGED_IN_KEY',    'zPZoJ&!6}upi(_J=M+Uv6f 4 bzZ]dMg:@ZB/:kI5?eM;|>ewp<&r? ~ed8ut|$g');
define('NONCE_KEY',        'FIu;J+|[N*)j*C$t$|qS]8Vn/BbEc$|:tAvC;~*{9hS#i?RlQ<8lrBtlDh@+H3*%');
define('AUTH_SALT',        'K?w||?(-Mn@QyiX fY:=S8%(-YOg[ p?c6(Xz2rM}jXsIZx-}-HE|i(AC8n{grNI');
define('SECURE_AUTH_SALT', '(o{*+fzA+$>YrUpC) `^l,E,|HS8+c$Rar-}~:i]3$2G_ROILPR+G1`Bb~eys|bL');
define('LOGGED_IN_SALT',   'm[*)k@x9gV-XS`_FK;%pp#yt(hv!bhk#~{uh-qw^Ve^VT*dTg78yY[@9/m0/z%-L');
define('NONCE_SALT',       '7yw1{RQ*[yN)as@LWX*_W>l*LqSZd2(GR#Fah`a6cV~BY )Lwb*9@8Aw%#b<R#R[');

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
