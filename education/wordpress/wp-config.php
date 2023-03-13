<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'education' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'r)$4cf[smM0<H{RqG<O$zlX%[slI%/8U2.eV74Pu>C1Uhj[RE<jHY%AV9AZ&4I8j' );
define( 'SECURE_AUTH_KEY',  '`S8<;G?Je#:Xi1tet&vZ@;`]6}CsP3<)I<F@fx%>-v+Pr=Y`8raGH`uk|O;f72|&' );
define( 'LOGGED_IN_KEY',    '`eFzwq[:EkgWZI?=_rmP91zje~,WmcwgE*2/vG!.zzYn7Xu]bBlFDElx{{]KuwR[' );
define( 'NONCE_KEY',        'TBSL1}Y[NS51R/G0@(=Xz#)QNsle:7u.6f+w(]@N2Jx$|!)n=spjy3SGFl;np8I)' );
define( 'AUTH_SALT',        'u]Nh!|t<N6Z[wKaH cY)(|Fo#64t29IE!.wu?ng:;^+E$/6.Kw?9y)@wSf2/+?h/' );
define( 'SECURE_AUTH_SALT', '8q@y_KtK;2eh^&B)[j>-FV7d3qa955D c)?j72Z1b}ZP]k:_wx8|+Fsz8dfQ)9tJ' );
define( 'LOGGED_IN_SALT',   'K>ZgH.na+5DzomC6/a(C+vQ;!#h/$931}jWV,BH2Z82%LlY6QC7GuJX.Xec!_,{T' );
define( 'NONCE_SALT',       'WQxfz_Dd+m[9p>B<J<0FE#9}a8.^4hJfR1q@U:je0tIa8SK)%[0>c[t!ZDxEFbLw' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
