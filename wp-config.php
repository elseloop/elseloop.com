<?php
// ===================================================
// Load database info and local development parameters
// ===================================================
if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
	define( 'WP_LOCAL_DEV', true );
	include( dirname( __FILE__ ) . '/local-config.php' );
} else {
	define( 'WP_LOCAL_DEV', false );
	define( 'DB_NAME', '%%DB_NAME%%' );
	define( 'DB_USER', '%%DB_USER%%' );
	define( 'DB_PASSWORD', '%%DB_PASSWORD%%' );
	define( 'DB_HOST', '%%DB_HOST%%' ); // Probably 'localhost'
}

// ========================
// Custom Content Directory
// ========================
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/content' );

// ================================================
// You almost certainly do not want to change these
// ================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// ==============================================================
// Salts, for security
// Grab these from: https://api.wordpress.org/secret-key/1.1/salt
// ==============================================================
define('AUTH_KEY',         '72pabQ(D|.B`5hd:,-@C(-[du!MfDz=Pk$/)5I[x1+TH|HCVxz{Z~BJCBd+z^c^y');
define('SECURE_AUTH_KEY',  'j^NN(;]Sx_Eg4NT0ySB-Db5Q[Yk$OIiFTuhb=L+;+HHR-m6KlyTvUk&ci|MdmtW(');
define('LOGGED_IN_KEY',    'nN2^,0MyQZPv?5--6xb[8MD:M417BTs+g;Yg9^Iw-?7N@y`@nk?t:cBX#&oe3n1/');
define('NONCE_KEY',        '?AeReDmMoqJ=dhBR%!/{+DSBdsfQPp4p?e{<r|G(RX&iN#D]^i*v<-)K$1%,MI9n');
define('AUTH_SALT',        'SEx<_asuX^_z+YW|:s9?(|-HU>Km]K<e*N+KQvY}2iRXki1Ch {?8IslR]T)CGkE');
define('SECURE_AUTH_SALT', '1&~Q1S,C+r/L,l JXrb2@ZOSmC IB),Q[-odm+RGAn<B67zE|,,!8#ozSsM<_>v.');
define('LOGGED_IN_SALT',   'Z+<~-b~pT1Q!:8K3KQ*+nahpO:Rq(e_J4;;G0qkvyJ;j8HR)x<i7ii]$r]oZK9WZ');
define('NONCE_SALT',       'Zbx*@GsX>|1[gN/P[U|BNJ{>tM-juPlK}#AbWvt}12w>RF<RqEc~,uA~iiKxYOZE');

// ==============================================================
// Table prefix
// Change this if you have multiple installs in the same database
// ==============================================================
$table_prefix  = 'wp_';

// ================================
// Language
// Leave blank for American English
// ================================
define( 'WPLANG', '' );

// ===========
// Hide errors
// ===========
ini_set( 'display_errors', 0 );
define( 'WP_DEBUG_DISPLAY', false );

// =================================================================
// Debug mode
// Debugging? Enable these. Can also enable them in local-config.php
// =================================================================
// define( 'SAVEQUERIES', true );
// define( 'WP_DEBUG', true );

// ======================================
// Load a Memcached config if we have one
// ======================================
if ( file_exists( dirname( __FILE__ ) . '/memcached.php' ) )
	$memcached_servers = include( dirname( __FILE__ ) . '/memcached.php' );

// ===========================================================================================
// This can be used to programatically set the stage when deploying (e.g. production, staging)
// ===========================================================================================
define( 'WP_STAGE', '%%WP_STAGE%%' );
define( 'STAGING_DOMAIN', '%%WP_STAGING_DOMAIN%%' ); // Does magic in WP Stack to handle staging domain rewriting

// ===================
// Bootstrap WordPress
// ===================
if ( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
require_once( ABSPATH . 'wp-settings.php' );
