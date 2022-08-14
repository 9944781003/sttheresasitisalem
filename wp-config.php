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
define( 'DB_NAME', 'touchsk1_wp195' );

/** MySQL database username */
define( 'DB_USER', 'touchsk1_wp195' );

/** MySQL database password */
define( 'DB_PASSWORD', 'p6Sw.rg[66' );

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
define( 'AUTH_KEY',         'ddwhdo5g2kbxyp0q55ndmepzczu5tay1nrkochxkle5ldxsqugp84c4mouh3g4tf' );
define( 'SECURE_AUTH_KEY',  'amdmv56vvabxiud7aag06pgojxd85vucv72recjzqlqymyvue1bzuwhnlh77acsw' );
define( 'LOGGED_IN_KEY',    'qtphmssnibxkweilxgaqlzcs2gf0yzbjyodeinzktlmgi35qowmbzjrxtubcgrpc' );
define( 'NONCE_KEY',        '4ccmzqxtfol1kxxaliwghtwo0lnwy7hbd1q3zwofpkwsfv9aiyvs4u1ysfadjl10' );
define( 'AUTH_SALT',        'zenrxfxvvnioqzwmc0oisaibnwimttlevjwowjbxg5n2tcgqfurnbqylw1osibbu' );
define( 'SECURE_AUTH_SALT', 'rtb9mlr8op2plwcp77sbswjljjpezyqcfz8f5iaj8ogmkkh408s1unbnueshboxk' );
define( 'LOGGED_IN_SALT',   'rrbqzv7picungvganvaipkzd8ijprpue7e9shtgph56pqkm7fsgodnooszhddgmz' );
define( 'NONCE_SALT',       'xwvpwbjud5hl1v0gvy4zrrbenpqqdi9vqgaxbvxzc5hskwuojwkj2ecrxmkawzxb' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wphx_';

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

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
#Added by HostingRaja Security Team, Please do not remove
define('DISALLOW_FILE_EDIT', true);
