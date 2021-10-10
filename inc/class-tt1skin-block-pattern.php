<?php
/**
 * ブロックパターンのカスタマイズ関連クラス.
 *
 * @since      0.0.1
 *
 * @package tt1skin
 */

if ( ! class_exists( 'TT1skin_Block_Pattern' ) ) {
	/**
	 * Msm Blocks
	 */
	class TT1skin_Block_Pattern {
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
				array( 'label' => 'TT1skin' )
			);
		}

		/**
		 * Register custom block pattern
		 */
		public static function register_block_patterns() {
			$skin_data = TT1skin_Skin_Data::get_instance()->get_skin_data();
			register_block_pattern(
				'tt1skin/card',
				TT1skin_Json_Controller::get_json_data( TT1SKIN_PATH . '/src/skins/' . $skin_data['name'] . '/block_pattern/card.json' )
			);
			register_block_pattern(
				'tt1skin/card--member',
				TT1skin_Json_Controller::get_json_data( TT1SKIN_PATH . '/src/skins/' . $skin_data['name'] . '/block_pattern/card--member.json' )
			);
		}
	}
}
