<?php

/**
 * Class tt1skin Config
 *
 * The file that defines the core plugin class
 *
 * @package tt1skin
 */

if (!class_exists('TT1skin_Block_Style')) {
	/**
	 * TT1skin Config
	 */
	class TT1skin_Block_Style
	{
		/**
		 * construct
		 */
		public static function init()
		{
			add_action('after_setup_theme', array(get_called_class(), 'block_style_setup'));
		}

		/**
		 * Add block styles
		 */
		public static function block_style_setup()
		{
			/**
			 * wp-block-heading
			 */
			register_block_style(
				'core/heading',
				array(
					'name'  => 'section-title',
					'label' => 'section title',
				)
			);
		}
	}
}
