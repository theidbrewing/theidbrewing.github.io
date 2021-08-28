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
		 * skin_data
		 *
		 * @var object $skin_data object getting from skin.json.
		 */
		public static $skin_data;

		/**
		 * Init
		 */
		public static function init() {

			// Get skin data.
			self::$skin_data = self::get_skin_datas();

			// Enqueue files.
			add_action( 'wp_enqueue_scripts', array( get_called_class(), 'set_enqueue_files' ) );

			if ( isset( self::$skin_data->settings->google_fonts_url ) ) {
				// Preconnect for Google Fonts.
				add_action( 'wp_head', array( get_called_class(), 'set_preconnect_google_fonts' ) );
			}
			// Set body class.
			add_filter( 'body_class', array( get_called_class(), 'set_body_class' ) );

			// Set Color Pallete.
			add_action( 'after_setup_theme', array( get_called_class(), 'set_custom_colors' ), 11 );
		}

		/**
		 * Set enqueue files
		 */
		public static function set_enqueue_files() {
			if ( is_object( self::$skin_data ) ) {
				$skin_name = self::$skin_data->name;
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
				// Enqueue Google fonts.
				if ( isset( self::$skin_data->settings->google_fonts_url ) ) {
					// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
					wp_enqueue_style( 'google-fonts', self::$skin_data->settings->google_fonts_url, array(), null );
					// phpcs:enable
				}
			}
		}

		/**
		 * Set preconnect for Google Fonts
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
		 * Set custom classes to body tag
		 *
		 * @param array $classes are CSS class names for body tag.
		 */
		public static function set_body_class( $classes ) {
			if ( isset( self::$skin_data->name ) ) {
				return array_merge( $classes, array( 'tt1skin', self::$skin_data->name ) );
			} else {
				return array_merge( $classes, array( 'tt1skin' ) );
			}
		}

		/**
		 * Set custom colors on the color palette
		 */
		public static function set_custom_colors() {
			if ( isset( self::$skin_data->settings->color->palette ) ) {
				$colors_array = (array) self::$skin_data->settings->color->palette;
				add_theme_support( 'editor-color-palette', $colors_array );
			}
		}
	}
}