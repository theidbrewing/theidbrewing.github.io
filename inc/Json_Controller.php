<?php
/**
 * Class tt1skin Json
 *
 * The file that defines the core plugin class
 *
 * @package tt1skin
 */

namespace theidbrewing\TT1_Skin;

/**
 * TT1skin Config
 */
class Json_Controller {
     /**
	 * 外部JSONを指定して配列を返す.
	 *
	 * @param string $path json file's path.
	 */
	public static function get_json_data( $path ) {
		// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		$json = file_get_contents( $path );
		// phpcs:enable
		$arr  = json_decode( $json , true );
		// TODO JSON error check
		return $arr;
	}
}
