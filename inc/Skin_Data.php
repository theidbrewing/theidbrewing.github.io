<?php
/**
 * Class tt1skin Skin Data
 *
 * The file that defines the skin data
 *
 * @package tt1skin
 */

namespace theidbrewing\TT1_Skin;

/**
 * TT1skin Skin Data
 */
class Skin_Data {
	/**
	 * skin_data
	 *
	 * @var object $skin_data object getting from skin.json.
	 */
	private $skin_data;
	/**
	 * instance
	 *
	 * @var object $instance object .
	 */
	private static $instance;

	/**
	 * construct
	 */
	public function __construct() {
		// Get skin data.
		if ( defined( 'TT1_SKIN_NAME' ) ) {
			$this->skin_data = $this->load_skin_datas( TT1_SKIN_NAME );
		} else {
			$this->skin_data = $this->load_skin_datas( 'theidbrewing' );
		}
	}

	/**
	 * Get Skin Instance
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new Skin_Data();
		}
		return self::$instance;
	}

	/**
	 * Get Skin Data
	 */
	public function get_skin_data() {
		return $this->skin_data;
	}

	/**
	 * Load datas from skin.json
	 *
	 * @param string $skin_dir_name is skin dir name from ./src/skins/xxx.
	 */
	public function load_skin_datas( $skin_dir_name ) {
		$skin_data = Json_Controller::get_json_data( THEIDBREWING_PATH . '/src/skins/' . $skin_dir_name . '/skin.json' );
		if ( ! isset( $skin_data ) || ! is_array( $skin_data ) ) {
			return;
		} else {
			return $skin_data;
		}
	}
}

