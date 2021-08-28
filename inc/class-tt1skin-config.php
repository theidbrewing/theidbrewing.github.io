<?php
/**
 * Class tt1skin Config
 *
 * The file that defines the core plugin class
 *
 * @package tt1skin
 */

if ( ! class_exists( 'TT1skin_Config' ) ) {
	/**
	 * TT1skin Config
	 */
	class TT1skin_Config {


		/**
		 * Init
		 */
		public static function init() {
			// Enqueue files.
			add_action( 'wp_enqueue_scripts', array( get_called_class(), 'set_enqueue_files' ) );
			// preconnect.
			// TODO Google Font が設定されているかどうか確認して実行するように変更する↓.
			add_action( 'wp_head', array( get_called_class(), 'set_preconnect_google_fonts' ) );
			// Set body class.
			add_filter( 'body_class', array( get_called_class(), 'set_body_class' ) );
		}

		/**
		 * Set enqueue files
		 */
		public static function set_enqueue_files() {
			// Get skin.json data.
			$skin_data = self::get_skin_datas();
			if ( is_object( $skin_data ) ) {
				$skin_name = $skin_data->name;
				if ( ! isset( $skin_name ) ) {
					$skin_name = 'tt1-skin-default';
				}
				// Enqueue CSS.
				wp_enqueue_style(
					$skin_name,
					TT1SKIN_URL . '/style.css',
					array(),
					filectime( TT1SKIN_PATH . '/style.css' )
				);
				// Google fonts が指定されていれば読み込む.
				if ( isset( $skin_data->settings->google_fonts_url ) ) {
					// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
					wp_enqueue_style( 'google-fonts', $skin_data->settings->google_fonts_url, array(), null );
					// phpcs:enable
				}
			}
		}

		/**
		 * Google Font用のpreconnect
		 */
		public static function set_preconnect_google_fonts() {
			echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
			echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
		}

		/**
		 * Get datas from skin.json
		 */
		public static function get_skin_datas() {
			$skin_data = TT1skin_Json_Controller::get_json_data( TT1SKIN_PATH . '/skin.json' );
			if ( ! isset( $skin_data ) || ! is_object( $skin_data ) ) {
				return;
			} else {
				return $skin_data;
			}
		}

		/**
		 * bodyに専用クラス付与
		 *
		 * @param array $classes are CSS class names for body tag.
		 */
		public static function set_body_class( $classes ) {
			// TODO JSONのスキン名を読み込ませる.
			return array_merge( $classes, array( 'tt1skin', 'theidbrewing' ) );
		}
	}
}
