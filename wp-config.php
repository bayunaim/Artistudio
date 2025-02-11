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
define( 'DB_NAME', 'Artistudio' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         '[X4P8TMw51BLLC9@G_@(}P{]*<FMdoJ4wDFb1$4K/T(ib41|:OA}!~ZS[Xzy7^-i' );
define( 'SECURE_AUTH_KEY',  '9.aP/U]QK+D3!HV,F^UJln[!GU/j=I az9!7]f[dQ[`RohLa6:P<*0]lo{lcOf4&' );
define( 'LOGGED_IN_KEY',    'bzvz?]b$=]fHo5~;K,a3[HL[kM59o?.e2_6rY$U4/ {5S7@ >tIqO=-2S2tAlZYB' );
define( 'NONCE_KEY',        'F.sHB-Y+xDWp%?Of8,0Rea%GKc#mXlV=V~6|!WNv0Jgc(V,a7 s2eQCnx^Vsq)1P' );
define( 'AUTH_SALT',        'j(DIDoM$v%#_w?>XFN5CnnR3p=ID}qPdf$_N`p_`^SXte}5AaA!FUks5qy?HU?Kv' );
define( 'SECURE_AUTH_SALT', 'jE/7_LA-SbAcK?6G}9X*DM[@fp[lM+dAy|5.acFmjMrR25_z`-SNey&{1~S~pGzV' );
define( 'LOGGED_IN_SALT',   'WfVy7znTG(%FA9[1GC{<$Pj}(|(v;/q(j,yyhD/ VP}:<IKg__8N{fU_f9q!s&dt' );
define( 'NONCE_SALT',       '&ietzD;}Ox#_.C]>q3t#;8^Ke:1[D8n^BV/+It#+:4I[WN_`l:e5c;S&l7Onnx<s' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
