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
define('DB_NAME', 'job');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'llc5f=cDKRNsu)!5H}E1_C&%N,Iu({g8{&@^|R=`~q@`h(*1S4?z97pYRP9c6Mx{');
define('SECURE_AUTH_KEY',  '%~V<UD`<i`o+]0Ld<{<;=|`^V;R,&~6**=qVwJ2 6Ig~2  3=j~y2k*Y&KLQ2$/Q');
define('LOGGED_IN_KEY',    '90i-U);w,(+c:qg+dg*5@lHh{x<_X4&})4TxhhI!VW@aSH/i+uA+J9>rzHO@w?ku');
define('NONCE_KEY',        'QEzG)jZPC ?G2<-2fmLIn^Qz Z[%6N=+PbT8v 7n5qLlbBVdLN;]d`=@!AtV7K-k');
define('AUTH_SALT',        'M/-ghs7n<$V^v27,R757<?i,rBhpppXjFeJGH%M)I{/;j|LqL@$uaRna1K-|,/hQ');
define('SECURE_AUTH_SALT', 'Ca<4n<Od]9+(xeyG,`;|}nqySyubE{l- 0L4KsT!q_G1O:X,W!HM7HA%0En}iBUe');
define('LOGGED_IN_SALT',   '*|jET2z?_GSdF<9GWA}.8fYO-sxm+[o}A84i]FM+(*lIop56Cf0-tO|}su;oMc@H');
define('NONCE_SALT',       '_F;;77Lshh6>P (&M;M+WSSX:tiM>{9eQv(q,7dCS,y[_:h*XtstE]#U+sHJk21=');

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
