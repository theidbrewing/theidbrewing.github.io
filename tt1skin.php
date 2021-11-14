<?php
/**
 * Plugin Name:       TT1 Skin - the_ID Brewing Styles
 * Description:       CSS styles for the_ID Brewing demo sites
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:
 * Author:            theidbrewing
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       tt1skin
 * Update URI:
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
// TT1 Skin data.
require_once TT1SKIN_PATH . '/inc/class-tt1skin-skin-data.php';

// TT1 Skin Main Class.
require_once TT1SKIN_PATH . '/inc/class-tt1skin.php';
TT1skin::init();

// TT1 Skin Block Style.
require_once TT1SKIN_PATH . '/inc/class-tt1skin-block-style.php';
TT1skin_Block_Style::init();

// TT1 Skin Block Pattern.
require_once TT1SKIN_PATH . '/inc/class-tt1skin-block-pattern.php';
TT1skin_Block_Pattern::init();

// TT1 Skin Customizer Colors.
require_once TT1SKIN_PATH . '/inc/class-tt1skin-customizer-colors.php';
TT1skin_Customizer_Colors::register_hooks();
