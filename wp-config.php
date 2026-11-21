<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv( 'WORDPRESS_DB_NAME' ) ?: 'portg' );

/** Database username */
define( 'DB_USER', getenv( 'WORDPRESS_DB_USER' ) ?: 'root' );

/** Database password */
define( 'DB_PASSWORD', getenv( 'WORDPRESS_DB_PASSWORD' ) ?: '' );

/** Database hostname */
define( 'DB_HOST', getenv( 'WORDPRESS_DB_HOST' ) ?: 'localhost' );

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
define( 'AUTH_KEY',         '[32Q84#/&a&3 PpL,j];0<qxKE<VNDg`(}&|yR@]D9p?jmGS_xz#md_==bA}(g-k' );
define( 'SECURE_AUTH_KEY',  'Gb?et<vV[esg,d2AMWhz%7+KTb0{lsUmFP7m-1o#z[u!9ghh2qhQDjV.,9NtL(E2' );
define( 'LOGGED_IN_KEY',    ',1Sg-H<RKrrm;V`sZn>@]b({~{lAdx;}RPLQ*q#x.rl=TMiSm2BZT!30?%Owjr`t' );
define( 'NONCE_KEY',        'e%S_/L*[(>l|#8CJ6HxR*Cr%kV|d57iX`./U]w^,,1wf(B][d-fBT*73TIg_}I`h' );
define( 'AUTH_SALT',        '7l+s0Wq%NFN~8fTQ*CG:,Y5#H9;,uCwc~I&:[{{IAqSRfd/|%<8KvmSHd_U_)7Xp' );
define( 'SECURE_AUTH_SALT', 'XAirgDwi9|EK4_:xGt=J/gRR],HuzV9p`gJ>/*`NY>fELv,CAmc8H]ai MKtO8F=' );
define( 'LOGGED_IN_SALT',   'f/^1M:}8RAd B6^JSjRG%jr,Ndye:3bI|J SyH)NX8 @!yKqK_=*T *6k/F~l?IP' );
define( 'NONCE_SALT',       's.b:F*fHHC^$]|KWafR,NM8;pOc5=xqefF8tD5c2gf(WPp8tRu} Q8Rxb4c9Qy&a' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */

define( 'WP_MEMORY_LIMIT', getenv( 'WP_MEMORY_LIMIT' ) ?: '512M' );
define( 'WP_MAX_MEMORY_LIMIT', getenv( 'WP_MAX_MEMORY_LIMIT' ) ?: '512M' );


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
