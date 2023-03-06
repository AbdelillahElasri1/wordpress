<?php
add_shortcode( 'stm_lms_featured_teacher', 'stm_lms_featured_teacher_shortcode' );

function stm_lms_featured_teacher_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'instructor' => '',
			'position'   => '',
			'bio'        => '',
			'image'      => '',
		),
		$atts
	);

	return STM_LMS_Templates::load_lms_template( 'shortcodes/stm_lms_featured_teacher', $atts );
}
