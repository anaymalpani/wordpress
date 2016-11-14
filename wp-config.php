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
define('DB_NAME', 'wordpress');

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
define('AUTH_KEY',         'V=~7qD`HChmu~xML5;]srltS7vXoPKlf[Z,f7U-/VD9d`7Qh )K{a[=7UjtII)?l');
define('SECURE_AUTH_KEY',  '6 Oc-0a2.tCWaI;,y$qZdNb$Xea(SKnu! =-tV(% pLpGU;IcOknSR-&?[SvAxaG');
define('LOGGED_IN_KEY',    '{07^70b()N4xhxk9I-8{G{9Nw+%}Bl 5Ar UjYT/&?tzk!B]ZQEpCu1=w>N@Eq]u');
define('NONCE_KEY',        'C.3/}<!XLHB?7d9(jwcGByLkj]$}?C*XrGi7lZ&i}I6*q[,>tUb@sxu67XE/-uyC');
define('AUTH_SALT',        'i^qFyfzJ#r~<I=]!OLaw_qg~N*;%%5p&Kz%E(U,>4Zov@?O0Z,YV?g?{E36oZ}p1');
define('SECURE_AUTH_SALT', '?JoM(N!u3ce1:@tIKVo^_M-wauUM`D1y*lJf$Mj(mWSw5iiQjUlmn+NHjV7+KWCG');
define('LOGGED_IN_SALT',   'jZp`=LlFQ9sjg?_^tOjs9/{x)ZPS-_KTkWY.|J-=c% U)9]-<M}BF)8XP4{n|Phg');
define('NONCE_SALT',       '($UWJwiHJ?tF[LxPaL~3E!R3@`*|N UTAY@@J;7A2y6A]f[8{d^NYS]Y2`wO;n(~');

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
