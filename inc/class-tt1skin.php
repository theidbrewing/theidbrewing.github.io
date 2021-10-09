<?php
/**
 * Class tt1skin
 *
 * The file that defines the core plugin class
 *
 * @package tt1skin
 */

if ( ! class_exists( 'TT1skin' ) ) {
	/**
	 * TT1skin
	 */
	class TT1skin {

		/**
		 * Init
		 */
		public static function init() {
			// Enqueue files.
			add_action( 'wp_enqueue_scripts', array( get_called_class(), 'set_enqueue_files' ) );

			// Set custom editor style.
			add_action( 'after_setup_theme', array( get_called_class(), 'my_editor_style_setup' ), 12 );

			if ( isset( TT1skin_Skin_Data::get_instance()->get_skin_data()->settings->google_fonts_url ) ) {
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
			$skin_data = TT1skin_Skin_Data::get_instance()->get_skin_data();
			if ( is_object( $skin_data ) ) {
				if ( isset( $skin_data->name ) ) {
					// Enqueue CSS.
					wp_enqueue_style(
						$skin_data->name,
						TT1SKIN_URL . '/build/skins/' . $skin_data->name . '/style.css',
						array(),
						filectime( TT1SKIN_PATH . '/build/skins/' . $skin_data->name . '/style.css' )
					);
				}
				// Enqueue Google fonts.
				if ( isset( $skin_data->settings->google_fonts_url ) ) {
					// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
					wp_enqueue_style( 'google-fonts', $skin_data->settings->google_fonts_url, array(), null );
					// phpcs:enable
				}
			}
		}

		/**
		 * Add custom editor style
		 *
		 * カスタムエディタースタイルを反映.
		 */
		public static function my_editor_style_setup() {
			$skin_data = TT1skin_Skin_Data::get_instance()->get_skin_data();
			add_theme_support( 'editor-styles' );
			// テーマからの相対パスで指定.
			if ( isset( $skin_data->name ) ) {
				$skin_plugin_path = '../../' . str_replace( WP_CONTENT_DIR, '', TT1SKIN_PATH );
				add_editor_style( $skin_plugin_path . '/build/skins/' . $skin_data->name . '/editor-style.css' );

			}
			// Enqueue Google fonts.
			if ( isset( $skin_data->settings->google_fonts_url ) ) {
				add_editor_style( $skin_data->settings->google_fonts_url, array() );
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
		 * Set custom classes to body tag
		 *
		 * @param array $classes are CSS class names for body tag.
		 */
		public static function set_body_class( $classes ) {
			if ( isset( TT1skin_Skin_Data::get_instance()->get_skin_data()->name ) ) {
				return array_merge( $classes, array( 'tt1skin', TT1skin_Skin_Data::get_instance()->get_skin_data()->name ) );
			} else {
				return array_merge( $classes, array( 'tt1skin' ) );
			}
		}

		/**
		 * Set custom colors on the color palette
		 */
		public static function set_custom_colors() {
			if ( isset( TT1skin_Skin_Data::get_instance()->get_skin_data()->settings->color->palette ) ) {
				$colors_array = json_decode( wp_json_encode( TT1skin_Skin_Data::get_instance()->get_skin_data()->settings->color->palette ), true );
				add_theme_support( 'editor-color-palette', $colors_array );
			}
		}

		/**
		 * Get skins directory
		 */
		public static function get_skins_directory() {
			$skins_dir      = TT1SKIN_PATH . '/src/skins';
			$skins_name_arr = array_diff( scandir( $skins_dir ), array( '..', '.' ) );
			return $skins_name_arr;
		}
	}
}
