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
define('DB_NAME', 'basketweit');

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
define('AUTH_KEY',         'Si(Qh<9!x%4L@|&8/[+:$(6-Ybg0*WMJe?/BJ|jFN-`)4L{R%qf?GJQE@_1s9HW]');
define('SECURE_AUTH_KEY',  'ADmR+-ZT8c <<ppx@2^=#a&CtMq]X0wgdtJ&P|7G1OWY6.#l]Jr0PU.ayx-iW-,|');
define('LOGGED_IN_KEY',    '%m@1jA<ebzUiVC2]~rCc{Zq$WB;V66;H7?icP-Weyr,zWH7yt&;=pG1X)FC$M)d7');
define('NONCE_KEY',        'hj1@P0$ke,b-cc*?hmEadS>8u!B}`d<[76d|V5dD2prA+4i<3y~nMr34dpB#s-1z');
define('AUTH_SALT',        'n8Bp5{|uKy>oIFV>ayl6ElJqt`YYio2zEO>%f{a/r_c6>&wx3z.~5r4Qm{h_C%*{');
define('SECURE_AUTH_SALT', 'X!:Fc!>Ip=M%Rth>*A9}fX<X$5t7:nlL&hUo04ML.pi(+{.D%Odotabpj8GA|_Bp');
define('LOGGED_IN_SALT',   '=~+OpBv#>)y-t-Evi2@!HMq2+)N=z`to-Av5dZD^OwVj+Z9(|@=L=go*&@Tq^xTq');
define('NONCE_SALT',       '{Hafk_OdQP}q+WV|Jp1*^7l-Bd^=|L2@%4[{W?y&](=lG*(h|aeST(]q#u|)[Ik ');

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
