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
define( 'DB_NAME', 'cmsdev_db' );

/** MySQL database username */
define( 'DB_USER', 'cmsdev_user' );

/** MySQL database password */
define( 'DB_PASSWORD', 'cmsdev_pass' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define( 'WP_DEBUG', true );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',            'd)$i&si.|Z,z0/}KR.S#%FClGjr.1zRgL3<On*3v?dR|=7/MN|?^YLOX*&ICLt @' );
define( 'SECURE_AUTH_KEY',     ',W+9<&Y3N1W1^vK9bH^wq%ls@|w6#R/7gZFrJB}mfLU1eUQ3Jx4r@e{aPn3r`=E#' );
define( 'LOGGED_IN_KEY',       '!KhN?A>],6X4I@lqqV.2L,htNSuSj8wo/:c1<b)Nj5b1S<Jo{5UO;,cK[7K3Jcaa' );
define( 'NONCE_KEY',           '4%-{P<i$PpV9RVAfk$u5^x8w<zu|#&J6 }];-iv-]Temi}-MZ_cM4{X>H0y!_I-N' );
define( 'AUTH_SALT',           ', HS^8Lc,lSjou#:&FsEEM-j-E8-%~H5Ge@w%icWb47~KW!_E%*x)z4odU ~v~%>' );
define( 'SECURE_AUTH_SALT',    ',,]2RrR,A8$qj^,L;2#}Wh$Cc2r,f>Grm{<yO+rE$?6SP>-Pj%O6y:; [n, -UJ1' );
define( 'LOGGED_IN_SALT',      '{u%n%$]<i,zl>f0:H{ao*|EdAADMs7MSnQ|P;^jGJhV}#q9DSc4BR]raOhMn7tZb' );
define( 'NONCE_SALT',          ';hIH/>w%)tIgr4wK1jq&6H^%sdp6LH5o!&.xtiIIrcB:4|Ps`8:C8BZ)@-i@6W3}' );

define( 'JWT_AUTH_SECRET_KEY', 'QjreREEAqg_e7XTN8yoeyB2vzSZz7uGyGecLk5vmnKs');
define('JWT_AUTH_CORS_ENABLE', true);

define('PODS_SHORTCODE_ALLOW_EVALUATE_TAGS',true);

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
