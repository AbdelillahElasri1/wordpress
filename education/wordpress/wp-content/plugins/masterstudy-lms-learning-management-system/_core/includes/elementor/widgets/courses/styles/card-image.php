<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

$this->start_controls_section(
	'style_card_image_section',
	array(
		'label' => esc_html__( 'Card: Image', 'masterstudy-lms-learning-management-system' ),
		'tab'   => Controls_Manager::TAB_STYLE,
	)
);
$this->add_group_control(
	Group_Control_Border::get_type(),
	array(
		'name'     => 'style_card_image_border',
		'selector' => '{{WRAPPER}} .ms_lms_courses_card_item_image',
	)
);
$this->add_control(
	'style_card_image_border_radius',
	array(
		'label'      => esc_html__( 'Border Radius', 'masterstudy-lms-learning-management-system' ),
		'type'       => Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', '%' ),
		'selectors'  => array(
			'{{WRAPPER}} .ms_lms_courses_card_item_image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);
$this->end_controls_section();
