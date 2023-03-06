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
define( 'AUTH_KEY',         '=rl<@pQX7Ra+k5Dw@ra~83g,_ pN}i~+4]ZWYc1RfA{^kMX4/*2f^/:i_+54K*<#' );
define( 'SECURE_AUTH_KEY',  'Vwgaiy9h9cQSGr%%zU&E*y~YST]x*+K}-tfh/)QV!wv/}QU^YB>tjLOl(:iTPL[x' );
define( 'LOGGED_IN_KEY',    '^|zfs?OMteS/!s1(BFFaJyq3>aW:<j6t`E;.|{UrL?*;sE[DPW0M1it5#UhRJ&HG' );
define( 'NONCE_KEY',        '^f]@w]mk{#^LyrZWo%K IE>4*}O~j<<w<6iy59_nc>*gM~a*@ w79!/o~x0+!?)B' );
define( 'AUTH_SALT',        'USk@-f9kJtE8snO?+`?W*qFT5Hjy5C*&n3RamOKWVTT$Vs3TG7uK5qGm|&/aLbJ>' );
define( 'SECURE_AUTH_SALT', 've2<Z?#Ub4k{W6frih9l~M+G~s6zOsCPO6?aOp*Ga^kdo/m1(7nii6.8_FQs[=Zx' );
define( 'LOGGED_IN_SALT',   '%|B|WBz$?q2dcBQ|C2}7%rE[4x1#V)f:xzI/M=sa=%0J[BAL$WFyn]pNu?|e6@|`' );
define( 'NONCE_SALT',       'UF^EcJd?G5AFN<HOL]0)5~2lY]Nf3:5RB4x4@;9n*&t5$QiHX5~8lFK5?;o]?9oF' );

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
