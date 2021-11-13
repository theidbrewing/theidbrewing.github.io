<?php
/**
 * Functions for flower skin
 *
 * The file that defines the core plugin class
 *
 * @package tt1skin
 */

add_action(
	'get_template_part_template-parts/footer/footer-widgets',
	function() {
		if ( 'twentytwentyone' === wp_get_theme()->get( 'TextDomain' ) ) {
			?>
		<p class="footer-site-description"><?php bloginfo( 'description' ); ?></p>
			<?php
		}
	}
);
