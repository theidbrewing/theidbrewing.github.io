<?php
/**
 * ブロックパターンのカスタマイズ関連クラス.
 *
 * @since      0.0.1
 *
 * @package tt1skin
 */

namespace theidbrewing\TT1_Skin;

	/**
	 * TT1Skin Block Pattern
	 */
class Block_Pattern {
	/**
	 * construct
	 */
	public static function init() {
		// TT1のデフォルトのパターンカテゴリを外す.
		// add_action( 'init', array( get_called_class(), 'unregister_tt1_pattern_category' ));
		// 独自カテゴリーを追加.
		add_action( 'init', array( get_called_class(), 'register_block_pattern_category' ) );
		// 独自パターンを追加.
		add_action( 'init', array( get_called_class(), 'register_block_patterns' ) );
	}

	/**
	 * Remove TT1 block patterns
	 */
	// public static function unregister_tt1_pattern_category() {
	// unregister_block_pattern_category( 'twentytwentyone' );
	// }

	/**
	 * Register custom block pattern category
	 */
	public static function register_block_pattern_category() {
		register_block_pattern_category(
			'tt1skin',
			array( 'label' => __( 'TT1skin', 'tt1skin' ) )
		);
	}

	/**
	 * Register custom block pattern
	 */
	public static function register_block_patterns() {
		$skin_data = Skin_Data::get_instance()->get_skin_data();
		if ( ! is_array( $skin_data ) ) {
			return;
		}
		if ( ! array_key_exists( 'block_pattern', $skin_data ) || ! is_array( $skin_data['block_pattern'] ) ) {
			return;
		}
		foreach ( $skin_data['block_pattern'] as $pattern ) {
			if ( ! file_exists( THEIDBREWING_PATH . '/src/skins/' . $skin_data['name'] . '/block_pattern/' . $pattern . '.json' ) ) {
				continue;
			}
			register_block_pattern(
				"tt1skin/{$pattern}",
				Json_Controller::get_json_data( THEIDBREWING_PATH . '/src/skins/' . $skin_data['name'] . "/block_pattern/{$pattern}.json" )
			);
		}
	}
}
