<?php
/**
 * Plugin Name:       TT1 Skin - the_ID Brewing Styles
 * Description:       CSS styles for the_ID Brewing demo sites
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.0.1
 * Author:            theidbrewing
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       tt1skin
 *
 * @package           tt1skin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'TT1SKIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'TT1SKIN_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );

if ( is_file( 'tt1skin.config.php' ) ) {
	require_once 'tt1skin.config.php';
}
// Json Controller.
require_once TT1SKIN_PATH . '/inc/class-tt1skin-json-controller.php';
// TT1 Skin Config.
require_once TT1SKIN_PATH . '/inc/class-tt1skin-config.php';
TT1skin_Config::init();
