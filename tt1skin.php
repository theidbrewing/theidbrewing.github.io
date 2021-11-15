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

define( 'THEIDBREWING_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'THEIDBREWING_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );

if ( file_exists( __DIR__ . '/tt1skin.config.php' ) ) {
	require_once __DIR__ . '/tt1skin.config.php';
}

if ( is_file( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

// Json Controller.
// require_once THEIDBREWING_PATH . '/inc/class-tt1skin-json-controller.php';
// TT1 Skin data.
// require_once THEIDBREWING_PATH . '/inc/class-tt1skin-skin-data.php';

// TT1 Skin Main Class.
\theidbrewing\TT1_Skin\Core::init();

// TT1 Skin Block Style.
\theidbrewing\TT1_Skin\Block_Style::init();

// TT1 Skin Block Pattern.
\theidbrewing\TT1_Skin\Block_Pattern::init();

// TT1 Skin Customizer Colors.
\theidbrewing\TT1_Skin\Customizer_Colors::register_hooks();

// TT1 Skin Updater.
\theidbrewing\TT1_Skin\Updater::init();
