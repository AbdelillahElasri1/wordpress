<?php

add_action( 'init' , 'get_education_about' );
function get_education_about(){

	Kirki::add_section( 'get_education_about_section', array(
        'title'   => esc_html__( 'Services', 'get-education' ),
        'section' => 'homepage'
    ) );

	Kirki::add_field( 'bizberg', array(
        'type'        => 'advanced-repeater',
        'label'       => esc_html__( 'Services', 'get-education' ),
        'section'     => 'get_education_about_section',
        'settings'    => 'get_education_about_section',
        'choices' => [
            'limit' => 3,
            'button_label' => esc_html__( 'Add Services', 'get-education' ),
            'row_label' => [
                'value' => esc_html__( 'Services', 'get-education' ),
            ],
            'fields' => [
            	'icon'  => [
	                'type'        => 'fontawesome',
	                'label'       => esc_html__( 'Icon', 'get-education' ),
	                'default'     => 'fab fa-accusoft',
	                'choices'     => bizberg_get_fontawesome_options(),
	            ],
                'serices_id'  => [
                    'type'        => 'select',
                    'label'       => esc_html__( 'Select Page', 'get-education' ),
                    'choices'     => bizberg_get_all_pages(),
                ],
            ],
        ],
    ) );

}