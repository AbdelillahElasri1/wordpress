<?php
add_shortcode( 'stm_lms_recent_courses', 'stm_lms_recent_courses_shortcode' );

function stm_lms_recent_courses_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'posts_per_page' => '',
			'image_size'     => '',
			'per_row'        => '6',
			'style'          => 'style_1',
		),
		$atts
	);

	return STM_LMS_Templates::load_lms_template( 'shortcodes/stm_lms_recent_courses', $atts );
}
