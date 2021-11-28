<?php
/**
 * Class tt1skin
 *
 * The file that defines the core plugin class
 *
 * @package tt1skin
 */

namespace theidbrewing\TT1_Skin;

/**
 * TT1_Skin Core
 */
class Core {

	/**
	 * Init
	 */
	public static function init() {
		// Enqueue files.
		add_action( 'wp_enqueue_scripts', array( get_called_class(), 'set_enqueue_files' ) );

		// Set custom editor style.
		add_action( 'after_setup_theme', array( get_called_class(), 'my_editor_style_setup' ), 12 );

		if ( isset( Skin_Data::get_instance()->get_skin_data()->settings->google_fonts_url ) ) {
			// Preconnect for Google Fonts.
			add_action( 'wp_head', array( get_called_class(), 'set_preconnect_google_fonts' ) );
		}
		// Set body class.
		add_filter( 'body_class', array( get_called_class(), 'set_body_class' ) );

		// Set Color Pallete.
		add_action( 'after_setup_theme', array( get_called_class(), 'set_custom_colors' ), 11 );

		// Set Gradient Pallete.
		add_action( 'after_setup_theme', array( get_called_class(), 'set_custom_gradients' ), 11 );

		// Set translate dir.
		add_action( 'plugin_loaded', array( get_called_class(), 'set_translate_dir' ) );

		// require functions.php.
		add_action( 'after_setup_theme', array( get_called_class(), 'load_functions' ), 10 );
	}

	/**
	 * Set enqueue files
	 */
	public static function set_enqueue_files() {
		$skin_data = Skin_Data::get_instance()->get_skin_data();
		if ( is_array( $skin_data ) ) {
			if ( isset( $skin_data['name'] ) ) {
				// Enqueue CSS.
				wp_enqueue_style(
					$skin_data['name'],
					THEIDBREWING_URL . '/build/skins/' . $skin_data['name'] . '/style.css',
					array(),
					filectime( THEIDBREWING_PATH . '/build/skins/' . $skin_data['name'] . '/style.css' )
				);
			}
			// Enqueue Google fonts.
			if ( isset( $skin_data['settings']['google_fonts_url'] ) ) {
				// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
				wp_enqueue_style( 'google-fonts', $skin_data['settings']['google_fonts_url'], array(), null );
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
		$skin_data = Skin_Data::get_instance()->get_skin_data();
		add_theme_support( 'editor-styles' );
		// テーマからの相対パスで指定.
		if ( isset( $skin_data['name'] ) ) {
			$skin_plugin_path = '../../' . str_replace( WP_CONTENT_DIR, '', THEIDBREWING_PATH );
			add_editor_style( $skin_plugin_path . '/build/skins/' . $skin_data['name'] . '/editor-style.css' );

		}
		// Enqueue Google fonts.
		if ( isset( $skin_data['settings']['google_fonts_url'] ) ) {
			add_editor_style( $skin_data['settings']['google_fonts_url'], array() );
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
		$skin_data = Skin_Data::get_instance()->get_skin_data();
		if ( isset( $skin_data['name'] ) ) {
			return array_merge( $classes, array( 'tt1skin', $skin_data['name'] ) );
		} else {
			return array_merge( $classes, array( 'tt1skin' ) );
		}
	}

	/**
	 * Set custom colors on the color palette
	 */
	public static function set_custom_colors() {
		$skin_data = Skin_Data::get_instance()->get_skin_data();
		if ( isset( $skin_data['settings']['color']['palette'] ) ) {
			$colors_array = $skin_data['settings']['color']['palette'];
			add_theme_support( 'editor-color-palette', $colors_array );
		}
	}

	/**
	 * Set custom gradient
	 */
	public static function set_custom_gradients() {
		$skin_data = Skin_Data::get_instance()->get_skin_data();
		if ( isset( $skin_data['settings']['color']['gradients'] ) ) {
			$gradient_array = $skin_data['settings']['color']['gradients'];
			add_theme_support( 'editor-gradient-presets', $gradient_array );
		}
	}

	/**
	 * Load functions.php
	 */
	public static function load_functions() {
		$skin_data = Skin_Data::get_instance()->get_skin_data();
		if ( isset( $skin_data['name'] ) ) {
			if ( is_file( THEIDBREWING_PATH . '/src/skins/' . $skin_data['name'] . '/functions.php' ) ) {
				require_once THEIDBREWING_PATH . '/src/skins/' . $skin_data['name'] . '/functions.php';
			}
		}
	}

	/**
	 * Get skins directory
	 */
	public static function get_skins_directory() {
		$skins_dir      = THEIDBREWING_PATH . '/src/skins';
		$skins_name_arr = array_diff( scandir( $skins_dir ), array( '..', '.' ) );
		return $skins_name_arr;
	}

	/**
	 * Set translate files
	 */
	public static function set_translate_dir() {
		load_plugin_textdomain( 'tt1skin', false, plugin_basename( dirname( __DIR__ ) ) . '/languages' );
	}
}
