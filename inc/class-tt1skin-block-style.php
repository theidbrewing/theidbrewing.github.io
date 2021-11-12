<?php
/**
 * Class tt1skin Block Style
 *
 * The file that defines Block Styles
 *
 * @package tt1skin
 */

if ( ! class_exists( 'TT1skin_Block_Style' ) ) {
	/**
	 * TT1skin Config
	 */
	class TT1skin_Block_Style {

		/**
		 * construct
		 */
		public static function init() {
			add_action( 'after_setup_theme', array( get_called_class(), 'block_style_setup' ) );
		}

		/**
		 * Add block styles
		 */
		public static function block_style_setup() {
			/**
			 * wp-block-heading
			 */
			register_block_style(
				'core/heading',
				array(
					'name'  => __( 'section-title', 'tt1skin' ),
					'label' => 'section title',
				)
			);
			/**
			 * wp-block-cover
			 */
			register_block_style(
				'core/cover',
				array(
					'name'  => __( 'special', 'tt1skin' ),
					'label' => 'special',
				)
			);
		}
	}
}
