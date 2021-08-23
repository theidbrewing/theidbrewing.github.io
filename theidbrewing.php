<?php

/**
 * Plugin Name:       the_id Brewing Styles
 * Description:       CSS styles for the_id Brewing demo sites
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            theidbrewing
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       theidbrewing
 *
 * @package           theidbrewing
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

define('THEIDBREWING_URL', untrailingslashit(plugin_dir_url(__FILE__)));
define('THEIDBREWING_PATH', untrailingslashit(plugin_dir_path(__FILE__)));

/**
 * JSとCSSの読み込み
 */
function set_enqueue_files()
{
    // Enqueue CSS.
    wp_enqueue_style(
        'altslogo_admin_style',
        THEIDBREWING_URL . '/style.css',
        array('wp-components'),
        filectime(THEIDBREWING_PATH . '/style.css')
    );
}
add_action( 'wp_enqueue_scripts', 'set_enqueue_files');
