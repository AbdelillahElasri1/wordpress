<?php
/**
 * Custom header implementation
 */

function education_insight_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'education_insight_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1200,
		'height'                 => 80,
		'flex-width'			 => true,
		'flex-height'			 => true,
		'wp-head-callback'       => 'education_insight_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'education_insight_custom_header_setup' );

if ( ! function_exists( 'education_insight_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see education_insight_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'education_insight_header_style' );
function education_insight_header_style() {
	if ( get_header_image() ) :
	$education_insight_custom_css = "
        .wrap_figure,.page-template-custom-home-page .wrap_figure{
			background-image:url('".esc_url(get_header_image())."') !important;
			background-position: center top;
			height: auto !important;
			background-size: 100% !important;
		}";
	   	wp_add_inline_style( 'education-insight-style', $education_insight_custom_css );
	endif;
}
endif;
