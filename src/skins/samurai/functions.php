<?php
/**
 * Functions for samurai skin
 *
 * The file that defines the core plugin class
 *
 * @package tt1skin
 */

add_action(
	'get_template_part_template-parts/content/content-single',
	function() {
		if ( 'twentytwentyone' === wp_get_theme()->get( 'TextDomain' ) ) {
			$category = get_the_category();
			$cat_name = $category[0]->cat_name;
			?>
		<header class="category-header alignwide">
			<p class="page-title"><?php echo esc_html( $cat_name ); ?></p>
		</header>
			<?php
		}
	}
);
