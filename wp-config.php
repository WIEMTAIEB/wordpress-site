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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'chainetv' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '[=D|J :kqp_R+*3{w6nuGGJNV1S()hon.>}%>d@0dBYV3gvGx6CXx`g-`@(cGV#/' );
define( 'SECURE_AUTH_KEY',  'w3 h^PIOb~t)](nfoQTpB=uQi$q9)(F]~0j/x{Xy$)q7dTv6<(sg-~eAvTb+ht$P' );
define( 'LOGGED_IN_KEY',    '{)mBVPQ?`8(=v9ue*;~j/l$[7s;CS D,NV(.fC)c6,bNUaBvm@Q20/ V!d*`LJ;v' );
define( 'NONCE_KEY',        'Y:|0J4Zq*>ybCW8JPZ+N=PN JeuAMHJ0H},UAwcA8V5n&OvY=](j%gyr*YhPeVo[' );
define( 'AUTH_SALT',        '#|>rr*Id61JXSpdHo]*yUIed-a};;0qokU+L:[JP/*AfE{4_ ~>?WmOF()h}cq.8' );
define( 'SECURE_AUTH_SALT', '6 %BbvFB9-dC%D17gHGqhBfeV+MkaJdyN:7NvY]~c}!l^Y-9glZ}^BuA90g<0S)Y' );
define( 'LOGGED_IN_SALT',   '!{1S2~0C5cmv`$0B`o&uepVUdqCL&Mc=t+?%Q1h8hot{C5;r*p:W 3oWRUOo3~I:' );
define( 'NONCE_SALT',       'md,!K:<ASspU{W($<A,C)^y?B[pvJ{ZGw>5JZy-ebw[)Lvz~7Bmj{W(x5}uB&<|7' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
define( 'FS_METHOD', 'direct' );


/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
