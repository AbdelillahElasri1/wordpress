<?php
function ms_lms_starter_customizer_register( $wp_customize ) {
	$wp_customize->add_setting(
		'ms_lms_starter_preloader',
		array()
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ms_lms_starter_preloader',
			array(
				'label'    => esc_html__( 'Enable Preloader', 'starter-text-domain' ),
				'section'  => 'title_tagline',
				'settings' => 'ms_lms_starter_preloader',
				'type'     => 'checkbox',
			)
		)
	);

	// Add Settings
	$wp_customize->add_setting(
		'ms_lms_loader_customizer_color_primary',
		array(
			'default' => '#04bfbf',
		)
	);

	$wp_customize->add_setting(
		'ms_lms_loader_customizer_color_secondary',
		array(
			'default' => '#45ace0',
		)
	);

	// Add Controls
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ms_lms_loader_customizer_color_primary',
			array(
				'label'    => 'Preloader Outline Color',
				'section'  => 'title_tagline',
				'settings' => 'ms_lms_loader_customizer_color_primary',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ms_lms_loader_customizer_color_secondary',
			array(
				'label'    => 'Preloader Inline Color',
				'section'  => 'title_tagline',
				'settings' => 'ms_lms_loader_customizer_color_secondary',
			)
		)
	);
}

add_action( 'customize_register', 'ms_lms_starter_customizer_register' );
