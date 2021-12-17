<?php
/**
 * Class tt1skin Custom Colors
 *
 * The file that defines the custom colors
 *
 * @package tt1skin
 */

namespace theidbrewing\TT1_Skin;

	/**
	 * TT1skin Customizer Colors
	 */
class Customizer_Colors {
	/**
	 * Register Hooks
	 */
	public static function register_hooks() {
		add_action( 'enqueue_block_editor_assets', array( get_called_class(), 'override_bg_color_to_editor' ) );
	}
	/**
	 * Override Bg Color to Editor
	 */
	public static function override_bg_color_to_editor() {
		// カスタマイザーの背景色設定を取得.
		$background_color = get_theme_mod( 'background_color', 'D1E4DD' );
		// カスタマイザーから背景色が設定されているか.
		if ( 'd1e4dd' !== strtolower( $background_color ) ) {
			$override_css  = '.wp-admin .editor-styles-wrapper.block-editor-writing-flow {';
			$override_css .= 'background-color: #' . $background_color . ';}';
			wp_register_style( 'tt1skin-for-tt1-customizer-color', false );
			wp_enqueue_style( 'tt1skin-for-tt1-customizer-color' );
			wp_add_inline_style( 'tt1skin-for-tt1-customizer-color', $override_css );
		}
	}
}
