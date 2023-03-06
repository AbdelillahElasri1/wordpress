<?php

add_action( 'init' , 'get_education_homepage_testimonial_section' );
function get_education_homepage_testimonial_section(){

	Kirki::add_section( 'get_education_testimonial_section', array(
        'title'   => esc_html__( 'Testimonial', 'get-education' ),
        'section' => 'homepage'
    ) );

    Kirki::add_field( 'bizberg', array(
    	'type'        => 'select',
    	'label'       => esc_html__( 'Select Testimonial', 'get-education' ),
	    'section'     => 'get_education_testimonial_section',
	    'settings'    => 'get_education_testimonial_page',
	    'choices'     => bizberg_get_all_pages(),
    ));

    Kirki::add_field( 'bizberg', [
		'type'     => 'text',
		'settings' => 'testi_name',
		'label'    => esc_html__( 'Name', 'get-education' ),
		'section'  => 'get_education_testimonial_section',
		'default'  => esc_html__( 'Alexis Jhon Marko', 'get-education' ),
	] );

	Kirki::add_field( 'bizberg', [
		'type'     => 'text',
		'settings' => 'testi_position',
		'label'    => esc_html__( 'Position', 'get-education' ),
		'section'  => 'get_education_testimonial_section',
		'default'  => esc_html__( 'Marketing Staff', 'get-education' ),
	] );

}