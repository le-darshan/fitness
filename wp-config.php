<?php
/** 
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information by
 * visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'cleaverfitness');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link http://api.wordpress.org/secret-key/1.1/ WordPress.org secret-key service}
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Jt)FqI#ibGp&&vW*7UNVR*Y)zEjtq5Xb#xKCJ3INwYTJoGDqnNJBshq6S*67F%Rt');
define('SECURE_AUTH_KEY',  '7I0418teF%JPnw%)(RQX8&6LtQ27CKRVMsoq0mizp3rkdbhQpRjIppgS11W&aur6');
define('LOGGED_IN_KEY',    'Gh(L1(44C*5LkVb94rSoZ6#0T1H*NEazEljEnZvhb49J6pi5%ozdeqVnZyWx1adi');
define('NONCE_KEY',        'TR4A^f@A*b5&kWfXtnto4LOdrNYAYkD2ovO3!Evrv1K$M^Q3i7hzl@2r1xB3xdSR');
define('AUTH_SALT',        'v)P8QPjuOJZougWGeESGLCLkfQANqW!ecUq&T76cKp$I1$q^ZegQTU2YUPpvd$(J');
define('SECURE_AUTH_SALT', '&hY!ao*fHmfyTPmjn1Z$8RB^ClK6hX)M!WqaoFJEhNB2e2%ACQHdkR8$VIWNt*$u');
define('LOGGED_IN_SALT',   'OJUPg%!LG7U&cG*CY&bc#EHf0&#4(364IaZ*7nu$!9GT(j2z%uzRtyoRxXig#D4Z');
define('NONCE_SALT',       'AC2ctXm(81wHh8yaeav*P!zWEtdqm8#4MGAcwmHQ46XBf(v0PBtl9PqbUZWog6%v');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = '2Jnxj_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', 'en_US');

define ('FS_METHOD', 'direct');

define('WP_DEBUG', false);
#define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

//--- disable auto upgrade
define( 'AUTOMATIC_UPDATER_DISABLED', true );



?>
