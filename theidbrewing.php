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
function theidbrewing_set_enqueue_files()
{
    // ENqueue Google Fonts.
    // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;700&family=Open+Sans:wght@600&family=Space+Mono:wght@400;700&display=swap', array(), null);
    // phpcs:enable
    // Enqueue CSS.
    wp_enqueue_style(
        'theidbrewing',
        THEIDBREWING_URL . '/style.css',
        array('wp-components'),
        filectime(THEIDBREWING_PATH . '/style.css')
    );
}
add_action('wp_enqueue_scripts', 'theidbrewing_set_enqueue_files');

function theidbrewing_set_enqueue_google_fonts()
{
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action('wp_head', 'theidbrewing_set_enqueue_google_fonts');
