<?php
/**
 * Class tt1skin Updater
 *
 * The file that defines the skin updater
 *
 * @package tt1skin
 */

if ( ! class_exists( 'TT1skin_Updater' ) ) {
	/**
	 * TT1skin Updater
	 */
	class TT1skin_Updater {
		/**
		 * init
		 */
		public static function init() {
			add_filter( 'pre_set_site_transient_update_plugins', array( get_called_class(), 'updater' ) );
		}

		/**
		 * Updater
		 *
		 * @param object $transient Transient for updatable plugins.
		 */
		public static function updater( $transient ) {

			// read current version.
			$plugin_data    = get_plugin_data( plugin_dir_path( dirname( __FILE__ ) ) . 'tt1skin.php' );
			$plugin_version = $plugin_data['Version'];
			if ( empty( trim( $plugin_version ) ) ) {
				$plugin_version = '0.0.1';
			}

			// read new version from theidbrewing.github.io.
			$repository_publish_uri = 'https://theidbrewing.github.io';
			$skin_data              = TT1skin_Skin_Data::get_instance()->get_skin_data();
			$skin_json_uri          = $repository_publish_uri . '/src/skins/' . $skin_data['name'] . '/skin.json';
			$skin_json_response     = wp_remote_get( $skin_json_uri );
			if ( 200 !== wp_remote_retrieve_response_code( $skin_json_response ) ) {
				return $transient;
			}
			$skin_json_response_body = json_decode( wp_remote_retrieve_body( $skin_json_response ) );
			if ( ! $skin_json_response_body ) {
				return $transient;
			}
			$skin_version = $skin_json_response_body->version;
			if ( empty( trim( $skin_version ) ) ) {
				return $transient;
			}
			// compare.
			if ( version_compare( $plugin_version, $skin_version, '<' ) ) {
				// set new version.
				$plugin_base_name = plugin_basename( dirname( dirname( __FILE__ ) ) );
				$transient->response[ $plugin_base_name . '/tt1skin.php' ] = (object) array(
					'id'            => $plugin_base_name . '/tt1skin.php',
					'slug'          => $plugin_base_name,
					'new_version'   => $skin_version,
					'url'           => $repository_publish_uri,
					'package'       => $repository_publish_uri . '/dist/tt1skin-' . $skin_data['name'] . '.zip',
					'compatibility' => new stdClass(),
				);
			}
			return $transient;
		}
	}
}
