<?php

function starter_get_demo_name() {
	$demo_name = get_option( 'stm_demo_name', 'main_demo' );

	return $demo_name;
}

function starter_color_styles() {
	$theme_settings = get_option( 'stm_theme_settings', array() );
	ob_start();
	?>
	:root {
		--text_color: <?php echo esc_html( ( ! empty( $theme_settings['text_color'] ) ) ? $theme_settings['text_color'] : '#303441' ); ?>;
		--primary_color: <?php echo esc_html( ( ! empty( $theme_settings['primary_color'] ) ) ? $theme_settings['primary_color'] : '#234dd4' ); ?>;
		--secondary_color: <?php echo esc_html( ( ! empty( $theme_settings['secondary_color'] ) ) ? $theme_settings['secondary_color'] : '#43C370' ); ?>;
		--heading_color: <?php echo esc_html( ( ! empty( $theme_settings['heading_color'] ) ) ? $theme_settings['heading_color'] : '#43C370' ); ?>;
		--link_color: <?php echo esc_html( ( ! empty( $theme_settings['link_color'] ) ) ? $theme_settings['link_color'] : '#303441' ); ?>;
		--link_color_on_action: <?php echo esc_html( ( ! empty( $theme_settings['link_color_action'] ) ) ? $theme_settings['link_color_action'] : '#234dd4' ); ?>;
		--body_font_family: <?php echo esc_html( ( ! empty( $theme_settings['body_font']['font-family'] ) ) ? $theme_settings['body_font']['font-family'] : 'Open Sans' ); ?>;
		--body_font_weight: <?php echo esc_html( ( ! empty( $theme_settings['body_font']['font-weight'] ) ) ? $theme_settings['body_font']['font-weight'] : '400' ); ?>;
		--body_font_size: <?php echo esc_html( ( ! empty( $theme_settings['body_font']['font-size'] ) ) ? $theme_settings['body_font']['font-size'] . 'px' : '14px' ); ?>;
		--body_line_height: <?php echo ( floatval( ( ! empty( $theme_settings['body_font']['line-height'] ) ) ? $theme_settings['body_font']['line-height'] . 'px' : '28px' ) / floatval( ( ! empty( $theme_settings['body_font']['font-size'] ) ) ? $theme_settings['body_font']['font-size'] . 'px' : '14px' ) ); ?>;
		--body_word_spacing: <?php echo esc_html( ( ! empty( $theme_settings['body_font']['word-spacing'] ) ) ? $theme_settings['body_font']['word-spacing'] . 'px' : '0' ); ?>;
		--body_letter_spacing: <?php echo esc_html( ( ! empty( $theme_settings['body_font']['letter-spacing'] ) ) ? $theme_settings['body_font']['letter-spacing'] . 'px' : '0' ); ?>;
		--h1_font_family: <?php echo esc_html( ( ! empty( $theme_settings['h1_font']['font-family'] ) ) ? $theme_settings['h1_font']['font-family'] : 'Poppins' ); ?>;
		--h1_font_weight: <?php echo esc_html( ( ! empty( $theme_settings['h1_font']['font-weight'] ) ) ? $theme_settings['h1_font']['font-weight'] : '700' ); ?>;
		--h1_font_size: <?php echo esc_html( ( ! empty( $theme_settings['h1_font']['font-size'] ) ) ? $theme_settings['h1_font']['font-size'] . 'px' : '44px' ); ?>;
		--h1_line_height: <?php echo esc_html( ( ! empty( $theme_settings['h1_font']['line-height'] ) ) ? $theme_settings['h1_font']['line-height'] . 'px' : '50px' ); ?>;
		--h1_word_spacing: <?php echo esc_html( ( ! empty( $theme_settings['h1_font']['word-spacing'] ) ) ? $theme_settings['h1_font']['word-spacing'] . 'px' : '0' ); ?>;
		--h1_letter_spacing: <?php echo esc_html( ( ! empty( $theme_settings['h1_font']['letter-spacing'] ) ) ? $theme_settings['h1_font']['letter-spacing'] . 'px' : '0' ); ?>;
		--h2_font_family: <?php echo esc_html( ( ! empty( $theme_settings['h2_font']['font-family'] ) ) ? $theme_settings['h2_font']['font-family'] : 'Poppins' ); ?>;
		--h2_font_weight: <?php echo esc_html( ( ! empty( $theme_settings['h2_font']['font-weight'] ) ) ? $theme_settings['h2_font']['font-weight'] : '700' ); ?>;
		--h2_font_size: <?php echo esc_html( ( ! empty( $theme_settings['h2_font']['font-size'] ) ) ? $theme_settings['h2_font']['font-size'] . 'px' : '42px' ); ?>;
		--h2_line_height: <?php echo esc_html( ( ! empty( $theme_settings['h2_font']['line-height'] ) ) ? $theme_settings['h2_font']['line-height'] . 'px' : '50px' ); ?>;
		--h2_word_spacing: <?php echo esc_html( ( ! empty( $theme_settings['h2_font']['word-spacing'] ) ) ? $theme_settings['h2_font']['word-spacing'] . 'px' : '0' ); ?>;
		--h2_letter_spacing: <?php echo esc_html( ( ! empty( $theme_settings['h2_font']['letter-spacing'] ) ) ? $theme_settings['h2_font']['letter-spacing'] . 'px' : '0' ); ?>;
		--h3_font_family: <?php echo esc_html( ( ! empty( $theme_settings['h3_font']['font-family'] ) ) ? $theme_settings['h3_font']['font-family'] : 'Poppins' ); ?>;
		--h3_font_weight: <?php echo esc_html( ( ! empty( $theme_settings['h3_font']['font-weight'] ) ) ? $theme_settings['h3_font']['font-weight'] : '500' ); ?>;
		--h3_font_size: <?php echo esc_html( ( ! empty( $theme_settings['h3_font']['font-size'] ) ) ? $theme_settings['h3_font']['font-size'] . 'px' : '36px' ); ?>;
		--h3_line_height: <?php echo esc_html( ( ! empty( $theme_settings['h3_font']['line-height'] ) ) ? $theme_settings['h3_font']['line-height'] . 'px' : '44px' ); ?>;
		--h3_word_spacing: <?php echo esc_html( ( ! empty( $theme_settings['h3_font']['word-spacing'] ) ) ? $theme_settings['h3_font']['word-spacing'] . 'px' : '0' ); ?>;
		--h3_letter_spacing: <?php echo esc_html( ( ! empty( $theme_settings['h3_font']['letter-spacing'] ) ) ? $theme_settings['h3_font']['letter-spacing'] . 'px' : '0' ); ?>;
		--h4_font_family: <?php echo esc_html( ( ! empty( $theme_settings['h4_font']['font-family'] ) ) ? $theme_settings['h4_font']['font-family'] : 'Poppins' ); ?>;
		--h4_font_weight: <?php echo esc_html( ( ! empty( $theme_settings['h4_font']['font-weight'] ) ) ? $theme_settings['h4_font']['font-weight'] : '500' ); ?>;
		--h4_font_size: <?php echo esc_html( ( ! empty( $theme_settings['h4_font']['font-size'] ) ) ? $theme_settings['h4_font']['font-size'] . 'px' : '30px' ); ?>;
		--h4_line_height: <?php echo esc_html( ( ! empty( $theme_settings['h4_font']['line-height'] ) ) ? $theme_settings['h4_font']['line-height'] . 'px' : '38px' ); ?>;
		--h4_word_spacing: <?php echo esc_html( ( ! empty( $theme_settings['h4_font']['word-spacing'] ) ) ? $theme_settings['h4_font']['word-spacing'] . 'px' : '0' ); ?>;
		--h4_letter_spacing: <?php echo esc_html( ( ! empty( $theme_settings['h4_font']['letter-spacing'] ) ) ? $theme_settings['h4_font']['letter-spacing'] . 'px' : '0' ); ?>;
		--h5_font_family: <?php echo esc_html( ( ! empty( $theme_settings['h5_font']['font-family'] ) ) ? $theme_settings['h5_font']['font-family'] : 'Poppins' ); ?>;
		--h5_font_weight: <?php echo esc_html( ( ! empty( $theme_settings['h5_font']['font-weight'] ) ) ? $theme_settings['h5_font']['font-weight'] : '500' ); ?>;
		--h5_font_size: <?php echo esc_html( ( ! empty( $theme_settings['h5_font']['font-size'] ) ) ? $theme_settings['h5_font']['font-size'] . 'px' : '24px' ); ?>;
		--h5_line_height: <?php echo esc_html( ( ! empty( $theme_settings['h5_font']['line-height'] ) ) ? $theme_settings['h5_font']['line-height'] . 'px' : '32px' ); ?>;
		--h5_word_spacing: <?php echo esc_html( ( ! empty( $theme_settings['h5_font']['word-spacing'] ) ) ? $theme_settings['h5_font']['word-spacing'] . 'px' : '0' ); ?>;
		--h5_letter_spacing: <?php echo esc_html( ( ! empty( $theme_settings['h5_font']['letter-spacing'] ) ) ? $theme_settings['h5_font']['letter-spacing'] . 'px' : '0' ); ?>;
		--h6_font_family: <?php echo esc_html( ( ! empty( $theme_settings['h6_font']['font-family'] ) ) ? $theme_settings['h6_font']['font-family'] : 'Poppins' ); ?>;
		--h6_font_weight: <?php echo esc_html( ( ! empty( $theme_settings['h6_font']['font-weight'] ) ) ? $theme_settings['h6_font']['font-weight'] : '600' ); ?>;
		--h6_font_size: <?php echo esc_html( ( ! empty( $theme_settings['h6_font']['font-size'] ) ) ? $theme_settings['h6_font']['font-size'] . 'px' : '18px' ); ?>;
		--h6_line_height: <?php echo esc_html( ( ! empty( $theme_settings['h6_font']['line-height'] ) ) ? $theme_settings['h6_font']['line-height'] . 'px' : '26px' ); ?>;
		--h6_word_spacing: <?php echo esc_html( ( ! empty( $theme_settings['h6_font']['word-spacing'] ) ) ? $theme_settings['h6_font']['word-spacing'] . 'px' : '0' ); ?>;
		--h6_letter_spacing: <?php echo esc_html( ( ! empty( $theme_settings['h6_font']['letter-spacing'] ) ) ? $theme_settings['h6_font']['letter-spacing'] . 'px' : '0' ); ?>;
	}
	<?php
	$css = ob_get_contents();
	ob_end_clean();
	return $css;
}

function starter_theme_activation() {
	if ( empty( get_option( 'stm_theme_settings', '' ) ) ) {
		$theme_options_json = file_get_contents( STM_INCLUDES_PATH . '/config.json', true );
		update_option( 'stm_theme_settings', json_decode( $theme_options_json, true ) );
	}
}

add_action( 'after_switch_theme', 'starter_theme_activation' );

function starter_theme_fonts() {
	$settings = get_option( 'stm_theme_settings', array() );

	$fonts         = array();
	$heading_fonts = array(
		'h1_font',
		'h2_font',
		'h3_font',
		'h4_font',
		'h5_font',
		'h6_font',
	);

	foreach ( $heading_fonts as $heading_font ) {
		if ( ! empty( $settings[ $heading_font ]['font-family'] ) ) {
			$fonts[] = "{$settings[$heading_font]['font-family']}:{$settings[$heading_font]['font-weight']}";
			$fonts[] = "{$settings[$heading_font]['font-family']}:{$settings[$heading_font]['font-weight']}i";
		} else {
			$fonts[] = 'Poppins:700,400';
		}
	}

	if ( ! empty( $settings['body_font']['font-family'] ) ) {
		$fonts[] = "{$settings['body_font']['font-family']}:{$settings['body_font']['font-weight']}";
		$fonts[] = "{$settings['body_font']['font-family']}:{$settings['body_font']['font-weight']}i";
		$fonts[] = "{$settings['body_font']['font-family']}:700";
		$fonts[] = "{$settings['body_font']['font-family']}:700i";
	} else {
		$fonts[] = 'Open Sans:700,400';
	}

	$subsets = apply_filters( 'google_fonts_subset', 'latin,latin-ext' );

	$query_args = array(
		'family' => rawurlencode( implode( '|', array_unique( $fonts ) ) ),
		'subset' => rawurlencode( $subsets ),
	);

	$fonts_url = ( ! empty( $fonts ) ) ? add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ) : '';

	return esc_url( $fonts_url );
}

add_action( 'init', 'starter_theme_fonts' );
