<?php
/**
 * Plugin Name: Super Addons For Elementor
 * Description: An Addon For Elementor.
 * Version:     1.0
 * Author:      Themehat
 * Author URI:  https://themehat.com
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 * Text Domain: safe
 */

 // Blocking direct access
if( ! defined( 'ABSPATH' ) ) {
    exit();
}

// Define Constant
define( 'SUPER_ADDONS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'SUPER_ADDONS_PLUGIN_INC_PATH', plugin_dir_path( __FILE__ ) . 'inc/' );
define( 'SUPER_ADDONS_PLUGIN_WIDGET_PATH', plugin_dir_path( __FILE__ ) . 'inc/widgets/' );
define( 'SUPER_ADDONS_PLUGDIRURI', plugin_dir_url( __FILE__ ) );
define( 'SUPER_ADDONS_ADDONS', plugin_dir_path( __FILE__ ) .'addons/' );

// load textdomain
load_plugin_textdomain( 'safe', false, basename( dirname( __FILE__ ) ) . '/languages' );

// include file.
require_once SUPER_ADDONS_PLUGIN_INC_PATH .'safecore-functions.php';

// addons
require_once SUPER_ADDONS_ADDONS . 'addons.php';