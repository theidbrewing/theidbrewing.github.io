<?php
/**
 * Class tt1skin Block Style
 *
 * The file that defines Block Styles
 *
 * @package tt1skin
 */

namespace theidbrewing\TT1_Skin;

	/**
	 * TT1skin Block Style
	 */
class Block_Style {

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
				'name'  => 'section-title',
				'label' => __( 'section title', 'tt1skin' ),
			)
		);
		/**
		 * wp-block-cover
		 */
		register_block_style(
			'core/cover',
			array(
				'name'  => 'special',
				'label' => __( 'special', 'tt1skin' ),
			)
		);
		register_block_style(
			'core/cover',
			array(
				'name'  => 'hero',
				'label' => __( 'hero', 'tt1skin' ),
			)
		);
	}
}

