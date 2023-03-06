<?php
add_shortcode( 'stm_lms_courses_grid', 'stm_lms_courses_grid_shortcode' );

function stm_lms_courses_grid_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'hide_top_bar'     => 'showing',
			'title'            => '',
			'hide_load_more'   => 'showing',
			'hide_sort'        => 'showing',
			'per_row'          => '6',
			'image_size'       => '',
			'taxonomy_default' => '',
			'posts_per_page'   => '',
		),
		$atts
	);

	return STM_LMS_Templates::load_lms_template( 'shortcodes/stm_lms_courses_grid', $atts );
}
