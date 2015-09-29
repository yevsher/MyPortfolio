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
define('DB_NAME', 'notify');

/** MySQL database username */
define('DB_USER', 'notifyAdmin');

/** MySQL database password */
define('DB_PASSWORD', '1234567890');

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
define('AUTH_KEY',         'T1701Uto,Ko|fma|-K*-55j9_nB|3gO)FZ@sL}Ekf_t^bB<m|C0C6LG>EV]*LnZC');
define('SECURE_AUTH_KEY',  'dm+hL?}:=Gu5NOOk6UkeQ$q?(4:*qV~Wu,yyhCBlW0`,<.tYf[;8)P}Ya(?Jjc~|');
define('LOGGED_IN_KEY',    '$|vtxY=PsX<a{S<T&WE`:)l .,(V,g=Q)w5u_P|~Y2QO2[f$ua+p[_ | }ao>X(M');
define('NONCE_KEY',        'bV1{K#5F+Ave/wbRNNt]F`dtLpdDfW5M9a|03uKa[,z6bv9inhf)#*=&O+In#u>G');
define('AUTH_SALT',        '?!S7CFbZZ5Xkle8H`|<V0m}iEE<5y3;e[Lx;!Wa;IF^h-hSG0:+unmYALO}#O{B`');
define('SECURE_AUTH_SALT', 'kC+:_t s9sL!hIa>Fb)F/pMPV[Uy#)%b/+:E%>sNQ!MrwL3u:cc2|-eT!G1jKz&_');
define('LOGGED_IN_SALT',   '0(;?5e:yJ;xDU+G:<d0^zdvZSB1sy|bjEnx+Hu+J.%h33}OCduN^7^_7|WSFXi^r');
define('NONCE_SALT',       '`;-bl(|LTW=e|PX+!arKf]HA0Kt`qDyC8JAC6_1.o;7ufG-M)s]MP(&]S0rw8E?W');

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
