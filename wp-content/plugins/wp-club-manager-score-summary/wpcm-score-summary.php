<?php
/**
* Plugin Name: WP Club Manager - Score Summary
* Version: 1.1
* Plugin URI: https://wpclubmanager.com/extensions/score-summary/
* Description: Adds interval scores to single match pages
* Author: Clubpress
* Author URI: http://wpclubmanager.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'WPCM_SS_PLUGIN_DIR' ) ) {
	define( 'WPCM_SS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'WPCM_SS_PLUGIN_URL' ) ) {
	define( 'WPCM_SS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'WPCM_SS_PLUGIN_FILE' ) ) {
	define( 'WPCM_SS_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'WPCM_SS_VERSION' ) ) {
	define( 'WPCM_SS_VERSION', '1.1' );
}

function wpcm_ss_textdomain() {
	load_plugin_textdomain( 'wpcm_ss', false, dirname( plugin_basename( WPCM_SS_PLUGIN_FILE ) ) . '/languages/' );
}
add_action( 'init', 'wpcm_ss_textdomain', -1 );


if( is_admin() ) {
	include_once( WPCM_SS_PLUGIN_DIR . 'includes/settings.php' );
}
include_once( WPCM_SS_PLUGIN_DIR . 'includes/scripts.php' );
include_once( WPCM_SS_PLUGIN_DIR . 'includes/scores-summary.php' );